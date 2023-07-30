<form action="" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $user[0]['id'] }}">
    <input type="password" name="password" value="{{ $user[0]['id'] }}">
    <br><br>
    <input type="password" name="konfirmasi_password" placeholder="COnfirm Password">
    <br><br>
</form>