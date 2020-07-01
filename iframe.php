<!DOCTYPE html>
<html>
    <head>
     <meta charset="UTF-8">
     <meta content='width=device-width, initial-scale=1.0' name='viewport'>
     <style type="text/css">
                body, html
                {
                    margin: 0; padding: 0; height: 100%; overflow: hidden;  -webkit-backface-visibility: visible;
                }

                #content
                {
                    position:absolute; left: 0; right: 0; bottom: 0; top: 0px;
                }
            </style>
    </head>
    <body>

    <script type="text/javascript">
    function onFrameLoad() {
            do stuff
    };
    </script>

    <div id="content">
    <iframe onload="onFrameLoad(this)" id="app" src="https://dev.tracifyapp.com/front/index?auth_id=0" frameborder="0" height="100%" width="100%"></iframe>
    </div
    </body>
    </html>