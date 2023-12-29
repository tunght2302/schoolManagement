@component('mail::message')
    {{-- Greeting --}}
    Xin chào, Admin,

    {{-- Introduction --}}
    Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.

    @component('mail::button', ['url' => url('reset/' . $user->remember_token), 'color' => 'primary'])
        Đặt lại mật khẩu
    @endcomponent

    {{-- Outro Lines --}}
    Nếu bạn không thực hiện yêu cầu này, bạn có thể bỏ qua email này.

    {{-- Signature --}}
    Trân trọng,<br>
    VELZON
@endcomponent
