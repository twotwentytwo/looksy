<p>Hi there</p>
<p>You requested a password change from PickList.</p>
<p>Click this link to reset your password: {{ route('auth.reset') }}?email={{ $user->email }}&identifier={{ urlencode($identifier) }}</p>