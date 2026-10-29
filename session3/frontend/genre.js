const API_URL = "../backend/api/genre-api.php";

const genreForm = document.getElementById("genreForm");

const nomInput = document.getElementById("Genre");
const descriptionInput = document.getElementById("Description");

const genreTableBody = document.getElementById("genreTableBody");

const btnSubmit = document.getElementById("btn-submit-form");

function setLoadingState(isLoading) {
    btnSubmit.disabled = isLoading;
    if (isLoading) {
        btnSubmit.textContent = "Enregistrement...";
    } else {
        btnSubmit.textContent = "Enregistrer";
    }
}

// 1. Charger les genres
function chargerGenres() {
    fetch(API_URL)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }

            return response.json();
        })
        .then((genres) => {
            genreTableBody.innerHTML = "";

            genres.forEach((genre) => {
                const ligne = document.createElement("tr");

                ligne.innerHTML = `
                    <td>${genre.id}</td>
                    <td>${genre.nom}</td>
                    <td>${genre.description}</td>
                `;

                genreTableBody.appendChild(ligne);
            });
        })
        .catch((error) => {
            console.error("Erreur lors du chargement des genres :", error);
        });
}


function showToast(message, type) {
    const toast = document.getElementById("toast");

    toast.textContent = message || "Une erreur est survenue.";

    toast.classList.remove("hidden", "bg-green-600", "bg-red-600");

    toast.classList.add(
        type === "success" ? "bg-green-600" : "bg-red-600"
    );

    // Affichage du texte
    toast.style.display = "block";
    toast.style.color = "white";
    toast.style.minWidth = "200px";
    toast.style.padding = "12px 20px";
    toast.style.fontSize = "14px";
    toast.style.fontWeight = "bold";
    toast.style.textAlign = "center";

    setTimeout(function () {
        toast.classList.add("hidden");
    }, 3000);
}

// 2. Ajouter un genre
genreForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const data = {
        nom: nomInput.value.trim(),
        description: descriptionInput.value.trim()
    };

    if (data.nom === "" || data.description === "") {
        showToast("Veuillez remplir tous les champs.", "error");
        return;
    }

    setLoadingState(true);

    fetch(API_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }

            return response.json();
        })
        .then(function (result) {
            if (result.success) {
                genreForm.reset();
                chargerGenres();
                showToast("Genre ajouté avec succès !", "success");
            } else {
                showToast(
                    result.message || "Erreur lors de l'ajout.",
                    "error"
                );
            }
        })
        .catch(function (error) {
            console.error("Erreur lors de l'ajout :", error);
            showToast("Une erreur est survenue.", "error");
        })
        .finally(function () {
            setLoadingState(false);
        });
});

// 3. Charger les genres au démarrage
chargerGenres();
showToast("Une erreur est survenue !", "error");