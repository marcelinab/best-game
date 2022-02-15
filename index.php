<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Best game</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        img {
            display: none;
        }
    </style>
</head>
<body>
<canvas id="canvas" width="800" height="600"></canvas>
<img id="cloud-image" src="img/cloud1.png">
<img id="player-image" src="img/p3_front.png">
<script>
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    }

    class Cloud {
        constructor(x, y) {
            this.x = x;
            this.y = y;
        }
    }

    class Player {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.target = x;
        }
        move(target) {
            this.target = target
        }
        tick() {
            if (this.target > this.x)
                this.x += 7
            if (this.target < this.x)
                this.x -= 7
        }
    }
    window.setTimeout(function () {
        let canvas = document.getElementById('canvas')
        let ctx = canvas.getContext('2d');
        let width = canvas.width
        let height = canvas.height

        let player_image = document.getElementById('player-image')
        let player = new Player((width / 2), height - player_image.height)
        let cloud_image = document.getElementById('cloud-image')
        let clouds = []
        for (let i = 0; i < 3; i++)
            clouds.push(new Cloud(getRandomInt(0, width - cloud_image.width), getRandomInt(0, (height / 2) - cloud_image.height)))


        canvas.onclick = function(event) {
            let target = event.clientX
            player.move(target)
        }

        function redraw() {
            ctx.fillStyle = 'rgb(208, 244, 247)';
            ctx.fillRect(0, 0, width, height)

            for (let i = 0; i < clouds.length; i++) {
                let cloud = clouds[i]
                ctx.drawImage(cloud_image, cloud.x, cloud.y)
            }

            ctx.drawImage(player_image, player.x - player_image.width / 2, player.y)

            player.tick()
            requestAnimationFrame(redraw)
        }
        requestAnimationFrame(redraw)
    }, 1000);

</script>
</body>
</html>