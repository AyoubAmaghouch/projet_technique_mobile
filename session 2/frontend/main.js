const API_URL = "../backend/api/vehicles.php";

const form = document.getElementById("vehicleForm");
const vehiclesList = document.getElementById("vehiclesList");


// ==================== READ ====================

async function getVehicles() {
    const response = await fetch(API_URL);
    const result = await response.json();

    vehiclesList.innerHTML = "";

    result.data.forEach(vehicle => {
        vehiclesList.innerHTML += `
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-bold">
                    ${vehicle.marque}
                </h2>

                <p>
                    Modèle : ${vehicle.modele}
                </p>

                <p>
                    Année : ${vehicle.annee}
                </p>
            </div>
        `;
    });
}


// ==================== CREATE ====================

form.addEventListener("submit", async (event) => {

    event.preventDefault();

    const vehicle = {
        marque: document.getElementById("marque").value,
        modele: document.getElementById("modele").value,
        annee: document.getElementById("annee").value
    };

    const response = await fetch(API_URL, {
        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify(vehicle)
    });

    const result = await response.json();

    console.log(result);

    form.reset();

    getVehicles();
});


// ==================== CHARGER LES VÉHICULES ====================

getVehicles();  