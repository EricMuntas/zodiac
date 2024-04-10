<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horoscope App</title>
</head>
<style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        #horoscope-result {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
</style>
<body>
    <h1>Horoscope App</h1>
    
  
    <form action="{{ route('horoscope.show') }}" method="GET">
        <label for="sign">Zodiac sign:</label>
        <select name="sign" id="sign">
            <option value="aquarius">Aquarius</option>
            <option value="pisces">Pisces</option>
            <option value="aries">Aries</option>
            <option value="taurus">Taurus</option>
            <option value="gemini">Gemini</option>
            <option value="cancer">Cancer</option>
            <option value="leo">Leo</option>
            <option value="virgo">Virgo</option>
            <option value="libra">Libra</option>
            <option value="scorpio">Scorpio</option>
            <option value="sagittarius">Sagittarius</option>
            <option value="capricorn">Capricorn</option>
        </select>

        <label for="time">Time period:</label>
        <select name="time" id="time">
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="week">This week</option>
            <option value="month">This month</option>
        </select>
        <label for="language">Language:</label>
        <select name="language" id="language">
            <option value="en">English</option>
            <option value="es">Spanish</option>
            <option value="ca">Catalan</option>
            <option value="pt">Portuguese</option>
            <option value="it">Italian</option>
            <option value="fr">French</option>
            <option value="de">German</option>
            <option value="pl">Polish</option>
        </select>

        <button type="submit">Get Horoscope</button>
    </form>

  <!-- resultat horoscop -->
    <div id="horoscope-result"></div>

    <script>
     
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); 
          
            var sign = document.getElementById('sign').value;
            var time = document.getElementById('time').value;
            var language = document.getElementById('language').value; 

      
            var url = "{{ route('horoscope.show') }}" + "?sign=" + sign + "&time=" + time + "&language=" + language;

         
            fetch(url)
                .then(response => response.text()) 
                .then(data => {
                    document.getElementById('horoscope-result').innerHTML = data; 
                })
                .catch(error => {
                    console.error('Error:', error); 
                });
        });
    </script>

</body>
</html>
