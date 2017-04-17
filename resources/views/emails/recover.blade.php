<p>Hi there,</p>
<p>You requested a password change from PickList.</p>
<p>Click this link to reset your password: {{ route('auth.reset') }}?email={{ $user->email }}&identifier={{ urlencode($identifier) }}</p>
<p><a href="http://www.picklist.co.uk">Great things happen when we share.</a></p>
<p>Thanks,</p>
<p>Chris &amp; Tom @ PickList.</p> 