<x-mail::message>
# Nouveau message reçu depuis le portfolio

**Nom :** {{ $contactMessage->name }}

**Email :** {{ $contactMessage->email }}

**Sujet :** {{ $contactMessage->subject }}

**Message :**

{{ $contactMessage->message }}

<x-mail::button :url="'mailto:' . $contactMessage->email">
Répondre
</x-mail::button>

Message reçu le {{ $contactMessage->created_at->format('d/m/Y à H:i') }}.
</x-mail::message>
