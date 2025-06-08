@component('mail::message')

<div style="margin-bottom: 30px;">
    <p style="color: #718096; font-size: 14px; text-align: center;">
        Thank you for contacting Galawij Gallery.<br>
        We will respond to your message as soon as possible.
    </p>
</div>

<div style="background-color: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
    <h2 style="color: #4a5568; font-size: 18px; margin-bottom: 15px;">Details</h2>
    <p style="margin: 5px 0;"><strong>Name:</strong> {{ $contact["name"] }}</p>
    <p style="margin: 5px 0;"><strong>Email:</strong> {{ $contact["email"] }}</p>
</div>


<div style="margin-bottom: 30px;">
    <h2 style="color: #4a5568; font-size: 18px; margin-bottom: 15px;">Message Content</h2>
    <div style="background-color: #f8fafc; padding: 20px; border-radius: 8px; white-space: pre-wrap;">
        {{ $contact["message"] }}
    </div>
</div>

<div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
    <p style="color: #a0aec0; font-size: 12px; text-align: center; margin-top: 15px;">
        This is an automated email. Please do not reply to this message.
    </p>
</div>
@endcomponent