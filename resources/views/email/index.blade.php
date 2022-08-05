@component('mail::message')
    Hallo, {{ $article['name'] }}
    {{ $article['body'] }}

    Hormat kami,
    Toko Komang Martini
@endcomponent