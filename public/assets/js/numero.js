document.addEventListener(
    'DOMContentLoaded',
    function () {


        const liste =
            document.getElementById(
                'listeTelephones'
            );


        /*
        Si l'utilisateur n'est pas sur MVOLA,
        la liste n'existe pas.
        On arrête le script.
        */

        if (!liste) {

            return;

        }


        /*
        Gestion des boutons
        + et -
        */

        liste.addEventListener(
            'click',
            function (event) {


                /*
                ==========================
                AJOUTER UN NUMERO
                ==========================
                */

                const boutonAjouter =
                    event.target.closest(
                        '.ajouterTelephone'
                    );


                if (boutonAjouter) {


                    const nouvelleLigne =
                        document.createElement(
                            'div'
                        );


                    nouvelleLigne.className =
                        'input-group mb-2 telephone-row';


                    nouvelleLigne.innerHTML = `

                        <input
                            type="text"
                            class="form-control"
                            name="telephones[]"
                            placeholder="034 12 345 67"
                            required
                        >

                        <button
                            type="button"
                            class="btn btn-danger supprimerTelephone"
                            title="Supprimer le numéro"
                        >

                            <i
                                class="bi bi-dash-lg"
                            ></i>

                        </button>

                    `;


                    liste.appendChild(
                        nouvelleLigne
                    );

                }


                /*
                ==========================
                SUPPRIMER UN NUMERO
                ==========================
                */

                const boutonSupprimer =
                    event.target.closest(
                        '.supprimerTelephone'
                    );


                if (boutonSupprimer) {


                    const ligne =
                        boutonSupprimer.closest(
                            '.telephone-row'
                        );


                    if (ligne) {

                        ligne.remove();

                    }

                }


            }
        );


    }
);
