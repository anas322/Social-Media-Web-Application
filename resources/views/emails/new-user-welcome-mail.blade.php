<x-mail::message>
# Welcome {{ $name }}
 
We're thrilled to see you here!.
 
<x-mail::button :url="$url">
My Profile
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>