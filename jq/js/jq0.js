
                // ------------
                function init() {
        $("#btAfficher").on("click", afficher);
        $("#btMasquer").on("click", masquer);
                } /// init

                // ----------------
                function afficher() {
        $("#img1").show("slow");
                } /// afficher

                // ---------------
                function masquer() {
        $("#img1").hide("slow");
                } /// masquer

                // --- Execute la fonction init() a la fin du chargement du document HTML
                $(document).ready(init);
