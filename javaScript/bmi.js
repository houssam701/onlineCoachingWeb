
        let popup = document.getElementById('popup');
        let content25 = document.getElementById('content25');
        function calculateBMI() {
            popup.classList.add('open-popup');
            var height_cm = parseFloat(document.getElementById('height').value);
            var weight = parseFloat(document.getElementById('weight').value);
            
            if (!isNaN(height_cm) && !isNaN(weight) && height_cm > 0 && weight > 0) {
                
                var height_m = height_cm / 100; // convert height from cm to m
                var bmi = weight / (height_m * height_m);
                
                if (bmi >= 18.6 && bmi <= 24.9) {
                    content25.innerHTML="Your BMI is Normal: " + bmi.toFixed(2);
                } else {
                    content25.innerHTML ="Your BMI is Overweight: " + bmi.toFixed(2);
                }
            }else{
                    content25.innerHTML="Please fill your height and your weight!"
            }
        }

        function closePopup(){
            popup.classList.remove('open-popup');
        }
        function openPopup(response){
            popup.classList.add('open-popup');
            content25.innerHTML=response;
        }