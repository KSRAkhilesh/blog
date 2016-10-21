<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Mail;
class PagesController extends Controller
{
	public function getIndex(){
		$posts = Post::orderBy('created_at','desc')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);
	}
	public function getAbout(){
		return view('pages.about');
	}
	public function getContact() {
		return view('pages.contact');
	}
	public function postContact(Request $request) {
		$this->validate($request,[
			'subject' => 'required|min:3',
			'email' => 'required|email', 
			'message' => 'required|min:10',
			]);
		 $data = array(
		 	'email' => $request->email,
		 	'subject' => $request->subject,
		 	'bodyMessage' =>$request->message,
		 	);
Mail::send('emails.contact', $data, function ($message) use($data){
    $message->from($data['email']);
    $message->to('ksrakhilesh@gmail.com', 'Akhilesh');
    $message->subject($data['subject']);
});
$request->session()->flash('success', 'Mail Sent Successfully You Will Get Reply Soon :D');
		return redirect()->route('blog.index');
	}
	
}
