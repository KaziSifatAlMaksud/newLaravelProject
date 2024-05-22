<!DOCTYPE html>
<html>
<head>
    <title>Video Recorder</title>
    <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <style>
        #preview, #recordedVideo {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div>
        <video id="preview" width="640" height="480" autoplay muted></video>
        <div>
            <button id="start">Start Recording</button>
            <button id="stop">Stop Recording</button>
            <span id="timer">00:00:00</span>
        </div>
        <video id="recordedVideo" width="640" height="480" controls></video>
    </div>
    <script>
        let preview = document.getElementById('preview');
        let recordedVideo = document.getElementById('recordedVideo');
        let startButton = document.getElementById('start');
        let stopButton = document.getElementById('stop');
        let timerDisplay = document.getElementById('timer');
        let recorder, stream;
        let startTime, timerInterval;

        function updateTimer() {
            let now = new Date().getTime();
            let elapsed = now - startTime;
            let hours = Math.floor(elapsed / (1000 * 60 * 60));
            let minutes = Math.floor((elapsed % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((elapsed % (1000 * 60)) / 1000);
            timerDisplay.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        startButton.addEventListener('click', async () => {
            stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            preview.srcObject = stream;
            recorder = new RecordRTC(stream, {
                type: 'video'
            });
            recorder.startRecording();
            startTime = new Date().getTime();
            timerInterval = setInterval(updateTimer, 1000);
        });

        stopButton.addEventListener('click', () => {
            clearInterval(timerInterval);
            recorder.stopRecording(async () => {
                let blob = recorder.getBlob();
                let url = URL.createObjectURL(blob);
                recordedVideo.src = url;
                recordedVideo.style.display = 'block';

                let formData = new FormData();
                formData.append('video', blob, 'video.webm');

                let response = await fetch('{{ route('video.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                if (response.ok) {
                    alert('Video uploaded successfully');
                } else {
                    alert('Failed to upload video');
                }

                stream.getTracks().forEach(track => track.stop());
            });
        });
    </script>
</body>
</html>