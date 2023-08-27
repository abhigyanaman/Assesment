<?php

?>

<head>
	<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.2/css/bootstrap.css"/>
	<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.2/css/react-select.css"/>
</head>

<body class="ReactModal_Body--open">
<div>Test</div>
<!--added on import-->
<div id="zmmtg-root"></div>
<div id="area-notify-area"></div>
<script src="https://source.zoom.us/1.7.2/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.7.2/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.7.2/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.7.2/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.7.2/lib/vendor/jquery.min.js"></script>
<script src="https://source.zoom.us/1.7.2/lib/vendor/lodash.min.js"></script>

<!--import zoom meeting-->
<script src="https://source.zoom.us/zoom-meeting-1.7.2.min.js"></script>

<!--import local .js file-->
<script type="text/javascript">

console.log("i am testing...");
const zoomMeeting = document.getElementById("zmmtg-root");
//for CDN version default
ZoomMtg.setZoomJSLib('https://dmogdx0jrul3u.cloudfront.net/1.7.2/lib','/av');

ZoomMtg.init({
	debug: true,//optional
	leaveUrl: 'index.php',//required
	webEndpoint: 'PS0 web domain',
	rwcEndpoint: 'PS0 rwc domain',
	rwcBackup: 'PS0 multi rwc domain',
	showMeetingHeader: true,//optional
	disableInvite: false,//optional
	disableCallOut: false,//optional
	disableRecord: false,//optional
	disableJoinAudio: false,//optional
	audioPanelAlwaysOpen: true,//optional
	showPureSharingContent: false,//optional
	isSupportAV: true,//optional
	isSupportChat: true,//optional>
	isSupportQA: true,//optional>
	isSupportCC: true,//optional>
	screenShare: true,//optional>
	rwcBackup: '',//optional>
	videoDrag: true,//optional>
	sharingMode: 'both',//optional>
	videoHeader: true,//optional>
	isLockBottom: true,//optional>
	isSupportNonverbal: true,//optional>
	isShowJoiningErrorDialog: true,//optional>
	
	
	


ZoomMtg.init({
            leaveUrl: 'http://www.zoom.us',
            isSupportAV: true,
            success: function () {
                ZoomMtg.join(
                    {
                        meetingNumber: meetConfig.meetingNumber,
                        userName: meetConfig.userName,
                        signature: signature,
                        apiKey: meetConfig.apiKey,
                        passWord: meetConfig.passWord,
                        success: function(res){
                            $('#nav-tool').hide();
                            console.log('join meeting success');
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    }
                );
            },
            error: function(res) {
                console.log(res);
            }
        });



</script>


</body>