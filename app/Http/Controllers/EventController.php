<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

use App\Models\User;

class EventController extends Controller
{
    
    public function index() {

        $search = request('search');

        if($search) {

            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $events = Event::all();
        }        
    
        return view('welcome',['events' => $events, 'search' => $search]);

    }
    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        

        // Image Upload
       
        $user = auth()->user();
        $event->user_id = $user->id; 

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');

    }

    public function show($id) {                 //controller de filtrar ID unico

        $event = Event::findOrFail($id);
        $eventOwner = User::where('id',$event->user_id)->first()->toArray(); //selecionando o usuario pelo ID unico
        return view('events.show', ['event' => $event,'eventOwner'=>$eventOwner]);
        
    }

    public function dashboard() {       
        $user = auth()->user();
        $events = $user->events;

        return view('events.dashboard',['events'=> $events]);
    }

    public function destroy($id) {    //controller para deletar um dado no banco
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg','Evento excluído com sucesso!');
    }

    public function edit($id) {
        $event = Event::findOrFail($id); //variavel vai receber um evento onde vai receber o ID mandado do front

        return view('events.edit',['event'=>$event]); //recebe o dado no banco de edit
    }
    public function update(Request $request) {

        $data = $request->all();

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;

        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }

}