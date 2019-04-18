@component('mail::message')
Article Created Successfully!
<hr>
{{$article->title}}
<br><br>
{{$article->description}}
<br><br>
{{$article->body}}

@component('mail::button', ['url' => url('/articles/' . $article->id)])
View Article
@endcomponent

Thanks,<br>
{{$article->Owner->name}}
@endcomponent
