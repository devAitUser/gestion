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

        show_order_product(item) {
           
             this.product_order =  item.product_order
            
            this.dialog = true
        },


        view_pdf(item) {
            
        
           window.open("facture_pdf/" + item.id, '_blank');
      
        },


        check_validation(item) {
            
           if(item.status == 2 ){
               return true
           } else {
               return false
           }
        },


        livre(item) {
          
            axios.post(window.laravel.url + '/livre/'+item.id)
                .then(response => {
                    if(response.data.etat){

                        location.reload();

                    }

                })
                .catch(error => {
                    console.log(error);
                })


        },

        clicked(value) {
            const index = this.expanded.indexOf(value)



            if (index === -1) {
                this.expanded.push(value)

            } else {
                this.expanded.splice(index, 1)
            }

        },

       

        
        remove_item() {

            if(this.btn_control){
                this.deleteItem();
            }
            else{

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Au moins un élément doit être sélectionné!',
                  })

            }

        }
        ,

        close() {

            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1

            })
            this.expanded = [];

        },

        item: function(values) {

            if (values.length > 0) {

                this.btn_control = true;

            } else {
                this.btn_control = false;

            }


        },

        deleteItem() {

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "voulez vous vraiment  supprimé",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Retour',
                confirmButtonText: 'Oui, Supprimé !'
            }).then((result) => {
                if (result.value) {

                    for (var i = 0; i < this.selected.length; i++) {

                        axios.delete(window.laravel.url + '/deletefacture/' + this.selected[i].id)
                            .then(response => {
                                console.log(response);

                            })
                            .catch(error => {
                                console.log(error);
                            })

                        const index = this.devis.indexOf(this.selected[i]);


                        this.devis.splice(index, 1);
                    }
                    this.selected = [];




                    this.btn_control = false;

                    Swal.fire({

                            title: 'Supprimer!',
                            html: ' supprimer aver succes.',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,


                            onBeforeOpen: () => {

                                timerInterval = setInterval(() => {
                                    const content = Swal.getContent()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                            b.textContent = Swal.getTimerLeft()
                                        }
                                    }
                                }, 100)
                            },
                            onClose: () => {
                                clearInterval(timerInterval)
                            }


                        }

                    )
                }
            })



        },
        valider(){
        
            window.location.href = "all_views_stock/" + this.projetSelected.id 
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