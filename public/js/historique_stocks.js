        new Vue({
    el: '#app',
    vuetify: new Vuetify(),

    data() {

        return {
            dialog: false,
            expanded: [],
            singleExpand: true,
            pagination: {
                rowsPerPage: 5,

            },
            show_button_validation : true,
            btn_control: false,
            singleSelect: false,
            selectedRows: [],
            selected: [],
            search: '',
            sortBy: 'id',
            personSelected:'',
            sortDesc: true,
            headers: [

                {
                    text: "Numero",
                    align: "left",
                    sortable: false,
                    value: "id"
                 },

                {
                    text: "Objet",
                    value: "objet"
                   },

                {
                    text: "Client",
                    align: "left",
                    sortable: false,
                    value: "client"
                },
                {
                    text: 'Visualiser le devis',
                    value: 'details'
                }

                



            ],

            devis: [

            ],
            editedIndex: -1,
            editedItem: {
                id: 0,
                client_id: 0,
                subtotal: 0,
                tva: 0,
                total: 0,
                typepaiement: '',
                statutpaiement: '',
            },
            defaultItem: {
                id: 0,
                client_id: 0,
                subtotal: 0,
                tva: 0,
                total: 0,
                typepaiement: '',
                statutpaiement: '',
            },
            array_projets :[]

        }
    },


    methods: {

    

        item: function(values) {

            if (values.length > 0) {

                this.btn_control = true;

            } else {
                this.btn_control = false;

            }


        },

        
        valider(){
        
            window.location.href = "all_views_historique_stock/" + this.projetSelected.id 
        },

        get_data: function() {

            axios.get(window.laravel.url + '/all_stocks/')
                .then(response => {

                  

                    this.array_projets = response.data;

                

                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    mounted: function() {

        this.get_data();



    }



})