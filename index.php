<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGym</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div>
        <header>
            <div class="navbar">
                <nav>
                <ul class="navlist">
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./proposal.php">Proposal</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="./about.php">About Me</a></li>
                </ul>
                </nav>
            </div>
            <div class="button">
                <?php
                session_start();
                if(isset($_SESSION['username'])){
                    echo '<a href="./welcome.php">My Profile</a>';
                }
                else echo '<a href="./membership.php">Become a Member</a>
                <a href="./login.php">Login</a>';
                ?>              
            </div>
        </header>
    </div>
    <div class="home">
        <div class="home_ele">
            <h1>Transform Your Body, Elevate <br>Your Life</h1>
            <p>Experience the power of fitness and community at our state-of-the-art gym</p>
            <a href="membership.php">Join Now</a>
        </div>
    </div>
    
    <div class="intro">
        <section>
            <h1>Welcome to MyGym!</h1>
            <p>Your fitness journey starts here. Join us for personalized workouts, expert trainers, and a supportive
                community.</p>
        </section>
    </div>
    <div>
        <section class="benefits">
            <h2>Why Choose MyGym?</h2>
            <ul>
                <li><strong>Exercise Controls Weight:</strong> Regular physical activity helps prevent excess weight
                    gain
                    and keeps you fit.</li>
                <li><strong>Combats Health Conditions:</strong> Exercise reduces the risk of heart disease, high blood
                    pressure, diabetes, and more.</li>
                <li><strong>Improves Mood:</strong> A gym session can boost your mood, reduce stress, and increase
                    happiness.</li>
                <li><strong>Boosts Energy:</strong> Strengthen your muscles, improve endurance, and tackle daily tasks
                    with
                    ease.</li>
                <li><strong>Promotes Better Sleep:</strong> Get better rest by staying active.</li>
            </ul>
        </section>
    </div>
    <div class="photo">
        <img src="image2.avif" alt="image">
        <img src="image3.avif" alt="image">
        <img src="image4.avif" alt="image">
    </div>
    <div class="quote">
        <section>
            <h3>“The body achieves what the mind believes.”</h3><br>
            <strong>
                our physical capabilities are not just determined by our bodily conditions
                but are also significantly influenced by our mental state.
                When we truly believe in our ability to achieve something,
                our mind sets a powerful intention that can drive our body to work towards that goal.
            </strong>
        </section><br>
        <section>
            <h3>“Discipline is the bridge between goals and accomplishment.” – Jim Rohn</h3>
            <strong>Discipline is the consistent effort we put towards our goals,
                regardless of obstacles, discomfort, or distractions.
                It’s about maintaining focus and a strong work ethic,
                even when motivation wanes. In the context of the gym,
                it means sticking to your workout routine, eating habits,
                and rest schedules to ensure that you reach your fitness objectives.
                Discipline ensures that you’re working towards your goals every day,
                making progress inevitable.</strong>
        </section><br>
        <section>
            <h3>All progress takes place outside the comfort zone.” – Michal Joan Bobak</h3>
            <strong>In fitness, this means pushing past your perceived limits,
                trying new exercises, increasing the intensity of your workouts,
                and challenging yourself consistently. It’s in these moments of discomfort that muscles grow,
                endurance improves, and personal records are broken.
                The comfort zone is a safe place, but it’s also where progress stagnates.
                To get stronger and fitter, you must venture outside of it.</strong>
        </section>
    </div>
</body>

</html>