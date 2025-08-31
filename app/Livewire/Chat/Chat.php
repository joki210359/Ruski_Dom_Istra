<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Notifications\MessageSentNotification;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Chat extends Component
{

    use WithFileUploads;
    public Conversation $conversation;


    public $receiver;
    public $body;

    public $loadedMessages;
    public $paginate_var = 10;


    function listenBroadcastedMessage($event)
    {

        // dd('reached');

        $this->dispatch('scroll-bottom');

        $newMessage = Message::find($event['message_id']);



        #push message

        $this->loadedMessages->push($newMessage);

        #mark as read

        $newMessage->read_at = now();
        $newMessage->save();
    }


    function sendMessage()
    {

        //$this->validate(['body'=>'required|string']);
        $this->validate([
            'images.*' => 'file|mimes:jpeg,png,webp,mp4,quicktime|max:2048', // max 2MB po datoteci
        ]);


        $createdMessage = Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiver->id,
            'body' => $this->body
        ]);

        #scroll to bottom
        $this->dispatch('scroll-bottom');

        $this->reset('body');

        #push the message
        $this->loadedMessages->push($createdMessage);


        #update the conversation model - for sorting in chatlist
        $this->conversation->updated_at = now();
        $this->conversation->save();

        #dispatch event 'refresh ' to chatlist 
        $this->dispatch('refresh')->to(ChatList::class);

        #broadcast new message

        $this->receiver->notify(new MessageSentNotification(
            auth()->user(),
            $createdMessage,
            $this->conversation
        ));
    }



    #[On('loadMore')]
    function loadMore()
    {

        //dd('reached');

        #increment
        $this->paginate_var += 10;

        #call loadMessage
        $this->loadMessages();

        #dispatch event- update height
        $this->dispatch('update-height');
    }


    function loadMessages()
    {

        #get count
        $count = Message::where('conversation_id', $this->conversation->id)->count();

        #skip and query

        $this->loadedMessages = Message::where('conversation_id', $this->conversation->id)
            ->skip($count - $this->paginate_var)
            ->take($this->paginate_var)
            ->get();

        return $this->loadedMessages;
    }

    function mount()
    {

        $this->receiver = $this->conversation->getReceiver();

        $this->loadMessages();
    }

    #[On('send-heart')]
    public function sendHeart()
    {
        $message = Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiver->id,
            'body' => '❤️',
        ]);

        $this->loadedMessages->push($message);

        $this->conversation->updated_at = now();
        $this->conversation->save();

        $this->dispatch('scroll-bottom');
        $this->dispatch('refresh')->to(ChatList::class);

        $this->receiver->notify(new MessageSentNotification(
            auth()->user(),
            $message,
            $this->conversation
        ));
    }

    public $datoteka;

    public function posaljiDatoteke()
    {
        $this->validate([
            'datoteka' => 'required|file|max:10240', // max 10MB
        ]);

        $path = $this->datoteka->store('uploads');
        // dalja obrada...
    }
    public $images = [];

    public function sendImages()
    {
        $this->validate([
            //'images.*' => 'file|mimes:jpeg,png,webp,mp4,mov,quicktime|1048576', // max 1GB
            'images.*' => 'file|mimes:jpeg,jpg,jfif,png,webp,mp4,mov,avi,mp3|max:1048576', // max 1GB
        ]);

        foreach ($this->images as $file) {
            $path = $file->store('chat-media', 'public'); // ili disk po želji

            Message::create([
                'user_id' => auth()->id(),
                'image' => $path,
                'conversation_id' => $this->conversation->id,
                'sender_id' => auth()->id(),
                'receiver_id' => $this->receiver->id,
                'body' => null, // ili '📷 Video/Slika'
                'media_path' => $path,
            ]);
        }

        $this->dispatch('scroll-bottom');
        $this->dispatch('refresh')->to(ChatList::class);

        $this->reset('images');
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
