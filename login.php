
<script>
    $(document).ready(function(){
        $('#masuk').on('click', function(e){
            let user = $('#account').val();
            let pass = $('#codepass').val();

            if((user == '') && (pass == '')){
                $('#account').focus();
            }else if(user == ''){
                $('#account').focus();
            }else if(pass == ''){
                $('#codepass').focus();
            }else{
                $.ajax({
                    url:'setlogin.php',
                    type:'POST',
                    dataType:'html',
                    data:{
                        vuser: user,
                        vpass: pass
                    },
                    success:function(a){
                        if(a == 'ok'){
                            alert("Login Berhasil");
                            window.location = 'loginprofile/mainprofile.php';
                            $('#account').val('');
                            $('#codepass').val('');
                        }else{
                            alert(a);
                            $('#account').val('');
                            $('#codepass').val('');
                            $('#account').focus();
                        }
                    }
                })
            }
        })
    })
</script>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md text-center mb-3">
                <h2>Login</h2>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" class="form-control" id="account" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" id="codepass" required>
                </div>
                <button type="submit" class="btn btn-primary" id="masuk">Login</button>
            </div>
        </div>
    </div>
</section>