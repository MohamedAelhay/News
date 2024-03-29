<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Actionable emails e.g. reset password</title>
    <link href={{asset("css/styles.css")}} media="all" rel="stylesheet" type="text/css" />
</head>

<body>

<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="content-wrap">
                            <table  cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <img class="img-responsive" src={{asset("img/header.jpg")}}/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <h3>Welcome to Mohamed A.Elhay Project</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        Congratulation you have been registered to our Project.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        Your E-Mail : {{$email}}
                                    </td>
                                </tr>
                                <tr>
                                    Kindly visit the link below to reset your password.
                                </tr>
                                <tr>
                                    <td class="content-block aligncenter">
                                        <a href="{{route('password.reset', $token)}}" class="btn-primary">Confirm email address</a>
                                    </td>
                                </tr>
                              </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td></td>
    </tr>
</table>

</body>
</html>
