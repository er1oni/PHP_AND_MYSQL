// Travel tips data for destinations including associated images

const travelTips = {

    paris: {

        tip: "Paris, the City of Light, is famous for its art, fashion, and landmarks like the Eiffel Tower. Don't miss the Louvre Museum! Eiffel Tower: No visit to Paris is complete without seeing the Eiffel Tower.<BR> Whether you’re gazing at it from the Champ de Mars park or enjoying panoramic views from the top, this iconic landmark is a must-see ",

        image: "DALL·E 2024-11-24 11.28.18 - A scenic illustration of Paris featuring iconic landmarks. The Eiffel Tower as the central focus, surrounded by picturesque elements such as the Seine.webp" // Path to the Paris image

    },

    tokyo: {

        tip: "Tokyo offers a perfect blend of traditional and modern attractions. Visit the Meiji Shrine and experience Shibuya Crossing.",

        image: "DALL·E 2024-11-24 11.29.46 - A stunning illustration of Sydney, Australia, showcasing iconic landmarks. Central focus on the Sydney Opera House with its unique sail-like design, a.webp" // Path to the Tokyo image

    },



    "new-york": {

        tip: "New York City is vibrant and diverse. Explore Times Square, Central Park, and the Statue of Liberty.",

        image: "DALL·E 2024-11-24 11.29.23 - A vibrant illustration of New York City showcasing iconic landmarks. Central focus on the Statue of Liberty with a backdrop of the Manhattan skyline, .webp" // Path to the New York image

    },



    sydney: {

        tip: "Sydney is known for its stunning Opera House, Harbour Bridge, and beautiful beaches like Bondi.",

        image: "1c1f576c-88f5-4d79-8d8c-ce0276d4d197.jpg"

    },



    london: {

        tip: "London, the capital of the United Kingdom, is a city full of history and culture. Visit landmarks like the Tower of London, Buckingham Palace, and the British Museum.",

        image: "56901c8a-aeaa-43f2-9358-cb616568cf29.jpg"

    },

    rome: {

        tip: "Rome is the heart of ancient history. Explore the Colosseum, the Roman Forum, and the Vatican City, including St. Peter's Basilica and the Sistine Chapel.",

        image: "cbef6c63-8a61-419e-957f-57b1fb9b3d45.jpg"

    },

    barcelona: {

        tip: "Barcelona is famous for its unique architecture by Gaudí, like the Sagrada Família and Park Güell. Don’t miss the beautiful beaches along the Mediterranean.",

        image: "476c4fb8-b782-498a-85a1-02e816e2e298.jpg"

    },

    dubai: {

        tip: "Dubai is known for its futuristic architecture, luxury shopping, and vibrant nightlife scene. Visit the Burj Khalifa, the world’s tallest building, and the Palm Jumeirah.",

        image: "22c2337f-c3a7-4896-8272-2bf93f268eeb.jpg"

    },

    cairo: {

        tip: "Cairo, the largest city in the Arab world, is home to the awe-inspiring Pyramids of Giza and the Sphinx, plus the Egyptian Museum.",

        image: "5553449d-ef8d-47a2-ae39-9cce8c22a8a6.jpg"

    },

    amsterdam: {

        tip: "Amsterdam is famous for its picturesque canals, historic museums, and vibrant culture. Don't miss the Anne Frank House and the Van Gogh Museum.",

        image: "f9be3e67-8861-4a0a-855b-cf8c8b526db0.jpg"

    },

    mumbai: {

        tip: "Mumbai, India's financial capital, is known for its Bollywood film industry, stunning beaches, and landmarks like the Gateway of India.",

        image: "f9be3e67-8861-4a0a-855b-cf8c8b526db0 copy.jpg"

    },

    singapore: {

        tip: "Singapore is a modern city-state known for its futuristic architecture, lush gardens, and iconic attractions like Marina Bay Sands and Gardens by the Bay.",

        image: "f9be3e67-8861-4a0a-855b-cf8c8b526db0 copy 2.jpg"

    },

    berlin: {

        tip: "Berlin is a city of history and culture, with landmarks like the Brandenburg Gate, Berlin Wall, and Museum Island.",

        image: "e2dbf752-7578-44b5-980e-dc94105e4211.jpg"

    },

    los_angeles: {

        tip: "Los Angeles is known for Hollywood, beautiful beaches, and iconic landmarks like the Walk of Fame, Venice Beach, and Griffith Observatory.",

        image: "d70a3c84-ecef-4b66-be60-0747a0eaa701.jpg"

    },

    bangkok: {

        tip: "Bangkok is a bustling city known for its ornate temples, vibrant street markets, and delicious street food. Don't miss the Grand Palace and Wat Arun.",

        image: "fb345361-7705-4cbe-bcbd-f8a6fc0eff14.jpg"

    },

    



}



// Handle getting travel tips based on the selected destination

function getDestinationInfo() {

    const selectElement = document.getElementById("destination-select");

    const selectedDestination = selectElement.value;

    const infoDiv = document.getElementById("destination-info");



    if (travelTips[selectedDestination]) {

        const { tip, image } = travelTips[selectedDestination];

        

        // Display the travel tip

        infoDiv.innerHTML = `<p>${tip}</p>`;

        

        // Display the image if available

        if (image) {

            const imgElement = document.createElement("img");

            imgElement.src = image;

            imgElement.alt = `${selectedDestination} image`;

            imgElement.style.maxWidth = "100%";

            imgElement.style.marginTop = "10px";

            infoDiv.appendChild(imgElement);

        }

    } else {

        infoDiv.textContent = "No travel tips available for the selected destination.";

    }

}



// Function to call the AI API

async function askAI() {

    const userInput = document.getElementById("user-query").value.trim();

    const responseDiv = document.getElementById("chatbot-response");



    if (!userInput) {

        responseDiv.textContent = "Please ask a question!";

        return;

    }



    // Show a loading message

    responseDiv.textContent = "Thinking...";



    try {

        const apiKey = "YOUR_API_KEY"; // Replace with your actual OpenAI API key

        const response = await fetch("https://api.openai.com/v1/completions", {

            method: "POST",

            headers: {

                "Content-Type": "application/json",

                Authorization: `Bearer ${apiKey}`

            },

            body: JSON.stringify({

                model: "text-davinci-003",

                prompt: `You are an AI travel assistant. Answer the following question: ${userInput}`,

                max_tokens: 150,

                temperature: 0.7

            })

        });



        const data = await response.json();

        if (data.choices && data.choices.length > 0) {

            responseDiv.textContent = data.choices[0].text.trim();

        } else {

            responseDiv.textContent = "Sorry, I couldn't understand your question. Please try again.";

        }

    } catch (error) {

        console.error("Error fetching AI response:", error);

        responseDiv.textContent = "An error occurred while fetching the AI response. Please try again later.";

    }

}









function getDestinationInfo() {

    const selectElement = document.getElementById("destination-select");

    const selectedDestination = selectElement.value;

    const infoDiv = document.getElementById("destination-info");



    infoDiv.innerHTML = ""; // Clear previous content



    if (travelTips[selectedDestination]) {

        const { tip, image } = travelTips[selectedDestination];



        // Display the travel tip

        const tipElement = document.createElement("p");

        tipElement.textContent = tip;

        infoDiv.appendChild(tipElement);



        // Display the image with advanced styles

        if (image) {

            const imgElement = document.createElement("img");

            imgElement.src = image;

            imgElement.alt = `${selectedDestination} image`;



            // Add advanced styles

            imgElement.style.maxWidth = "100%";

            imgElement.style.height = "auto";

            imgElement.style.borderRadius = "15px"; // Rounded corners

            imgElement.style.boxShadow = "0 10px 20px rgba(0, 0, 0, 0.2)"; // Soft shadow

            imgElement.style.border = "3px solid #f0f0f0"; // Light border

            imgElement.style.marginTop = "20px";

            imgElement.style.transition = "transform 0.3s ease, box-shadow 0.3s ease"; // Smooth transition effects



            // Add a hover effect

            imgElement.onmouseover = () => {

                imgElement.style.transform = "scale(1.05)"; // Slight zoom-in

                imgElement.style.boxShadow = "0 15px 30px rgba(0, 0, 0, 0.3)"; // Enhanced shadow

            };

            imgElement.onmouseout = () => {

                imgElement.style.transform = "scale(1)"; // Reset zoom

                imgElement.style.boxShadow = "0 10px 20px rgba(0, 0, 0, 0.2)"; // Reset shadow

            };



            infoDiv.appendChild(imgElement);

        }

    } else {

        infoDiv.textContent = "No travel tips available for the selected destination.";

    }

}