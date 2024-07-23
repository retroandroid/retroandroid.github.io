<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.1/css/bulma.min.css">
    <style>
    body{
        height: 100vh;
        background-color: #00091a;
    }
    label{
        padding:10px;
        margin:5px;
        vertical-align: middle;
    }
        .popup {
            display: none;
            position: fixed;
            top: -100%; /* Start off-screen */
            left: 50%;
            transform: translate(-50%, 0);
            padding: 40px;
            background-color: #00091a; /* Updated background color */
            color: white; /* Ensure text is readable on dark background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-radius: 25px;
            width: 80%; /* Default width for mobile */
            border:5px solid;
            border-color: #00cfaf;
        }

        .popup.show {
            display: block;
            animation: slide-in 0.5s forwards ;
        }

        @keyframes slide-in {
            from {
                top: -100%;
            }
            to {
                top: 40%;
            }
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup-overlay.show {
            display: block;
        }

        /* Media queries for responsiveness */
        @media (min-width: 768px) {
            .popup {
                width: 50%; /* Adjust width for tablets and desktops */
            }
        }

        @media (min-width: 1024px) {
            .popup {
                width: 30%; /* Adjust width for larger screens */
            }
        }
        label{
            --bulma-title-color:black;
        }
    </style>
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <form id="formcontainer" style="width:100%">
                        <div class="field">
                            <label for="equation" class="title is-1">Select properties:</label>
                        </div>
                        <div class="field">
                            <label class="title is-3">Hb count</label>
                            <div class="control">
                                <input type="number" id="hb" name="hb" step="0.1" required class="input is-large is-info is-rounded">
                            </div>
                        </div>
                        <div class="field">
                            <label class="title is-3">Platelet count</label>
                            <div class="control">
                                <input type="number" id="pc" name="pc" step="0.01" required class="input is-large is-info is-rounded">
                            </div>
                        </div>
                        <div class="field">
                            <label class="title is-3">Leucocyte count</label>
                            <div class="control">
                                <input type="number" id="lc" name="lc" required class="input is-large is-info is-rounded">
                            </div>
                        </div>
                        <div class="field">
                            <label class="title is-3">Neutrophil count</label>
                            <div class="control">
                                <input type="number" id="nc" name="nc" required class="input is-large is-info is-rounded">
                            </div>
                        </div>
                        <input type="submit" id="submitbutton" class="button is-info is-outlined is-rounded is-large">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="popup" class="popup">
        <p id="popupContent"></p>
        <button id="closePopup" class="button is-info is-outlined">Close</button>
    </div>
    <div id="popupOverlay" class="popup-overlay"></div>

    <script>
        document.getElementById('formcontainer').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Collect form data
            var formData = new FormData(document.getElementById('formcontainer'));

            // Send form data via AJAX
            fetch('process_form.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Display the popup with the response data
                document.getElementById('popupContent').innerHTML = data;
                var popup = document.getElementById('popup');
                var popupOverlay = document.getElementById('popupOverlay');
                popup.classList.add('show');
                popupOverlay.classList.add('show');
            })
            .catch(error => console.error('Error:', error));
        });

        document.getElementById('closePopup').addEventListener('click', function() {
            var popup = document.getElementById('popup');
            var popupOverlay = document.getElementById('popupOverlay');
            popup.classList.remove('show');
            popupOverlay.classList.remove('show');
        });

        document.getElementById('popupOverlay').addEventListener('click', function() {
            var popup = document.getElementById('popup');
            var popupOverlay = document.getElementById('popupOverlay');
            popup.classList.remove('show');
            popupOverlay.classList.remove('show');
        });
    </script>
</body>
</html>