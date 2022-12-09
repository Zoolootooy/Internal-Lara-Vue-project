<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Benefit;
use App\Models\Product;
use Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Page;
use App\Models\Slider;
use App\Models\MediaFile;
use App\Models\MediaCategory;
use Illuminate\Support\Facades\Mail as MailSend;
use App\Mail\FeedbackMail;
use App\Models\Quote;
use App\Models\FaqCategory;
use App\Models\Mail;
use App\Http\Requests\FrontMailRequest as MailRequest;
use App\Notifications\NotificationService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var string
     */
    public $controllerName = 'home';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::getRecordBySlug('index');

        abort_unless($page->visible, 404);

        $itemNumber = 5;

        $slides = Slider::visible()->get();
        $articles = Article::visible()->orderBy('created_at', 'desc')->take(2)->get();

        $quotes = Quote::visible()->get();
//        $faqs = FaqCategory::visible()->get();
        $faqs = FaqCategory::visible()->where('slug', 'main-page')->first()->items;
//        $images = MediaFile::categoryRecords(MediaCategory::CATEGORY_IMAGE, $itemNumber);
        $images = MediaFile::whereHas('category', function ($q) {
            $q->where('media_categories.slug', 'gallery');
        })->get();
        $benefits = Benefit::visible()->get();
        $users = User::roleRecords(Role::ROLE_TEAM_MEMBER);

        return $this->view('index', compact('page', 'slides', 'articles', 'benefits', 'quotes', 'faqs', 'images', 'users'));
    }

    /**
     * @param Page $page
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page(Page $page, $data = [])
    {
        abort_unless($page->visible, 404);

        return $this->view('page', compact('page'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        $page = Page::where('slug', 'contact')->first();

        return $this->view('contact', compact('page'));
    }

    /**
     * @param MailRequest $request
     * @return bool
     * @throws \Exception
     */
    public function send(MailRequest $request)
    {
        $mail = new Mail($request->all());
        $mail->save() && NotificationService::sendContactNotification($mail);
        $mailSend = ['user_email'=>$request->sender_email,
            'user_name'=>$request->sender_name,
            'sender_site' => "http://internal-english-bg",
            'subject' => $request->subject,
            'feedback_id' => $mail['id'],
            'body' => $request->body];
        return MailSend::to($request->sender_email)->send(new FeedbackMail($mailSend));
    }

    public function articles()
    {
        $page = Page::where('slug', 'articles')->first();
        $articles = Article::visible()->orderBy('created_at', 'desc')->get();

        return $this->view('articles', compact('page', 'articles'));
    }

    public function articlesCurrent($id)
    {
        $article = Article::find($id);
        $page = Page::find($id);
        return $this->view('currentArticle', compact('page','article'));
    }

    public function purchase()
    {
        $page = Page::where('slug', 'purchase')->first();
        $product = Product::visible()->where('type', '0')->first();
        $extraCards = Product::visible()->where('type', 'extra-cards')->first();

        return $this->view('purchase', compact('page', 'product', 'extraCards'));
    }
}
