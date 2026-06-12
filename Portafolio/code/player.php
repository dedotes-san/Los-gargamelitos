<!DOCTYPE html>
<html>
<body style="margin:0; background:transparent;">

<audio id="music" src="sounds/battle.mp3" loop autoplay></audio>

<script>
const music = document.getElementById("music");

// VOLUMEN
music.volume = 0.3;

// CONTROL GLOBAL
window.addEventListener("message", (e) => {
    if(e.data === "play") music.play();
    if(e.data === "pause") music.pause();
});
</script>

</body>
</html>
