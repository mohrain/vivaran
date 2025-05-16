@if(isset($office) && $office->office_logo)
    <img src="{{ asset('storage/' . $office->office_logo) }}" alt="Logo" {{ $attributes }}>
@else
    <img src="{{ asset('storage/logo/Emblem_of_Nepal.png') }}" alt="Default Logo" {{ $attributes }}>
@endif