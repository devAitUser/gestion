new Vue({
    el: '#app_client',
    vuetify: new Vuetify(),

    data() {

        return {
            dialog: false,
            expanded: [],
            singleExpand: true,
            pagination: {
                rowsPerPage: 5,

            },
            btn_control: false,
            singleSelect: false,
            selectedRows: [],
            selected: [],
            search: '',
            sortBy: 'id',
            sortDesc: true,

            headers: [

       
                {
                    text: 'Numero',
                    value: 'id'
                },
                {
                    text: 'Etat paiement',
                    value: 'etat_paiement'
                },
                {
                    text: "Historique paiement",
                    value: "paiement",
                    sortable: false
                }
                ,
                {
                    text: "Paiement",
                    value: "paiement_facture",
                    sortable: false
                }
               


            ],

            subHeaders: [  
                {
                 text: "Mode paiement",
                 align: "left",
                 sortable: false,
                 value: "mode_paiement"
                },
                {
                   text: "n cheque",
                   value: "n_cheque"
                  },
                  {
                   text: "date cheque",
                   value: "date_cheque"
                  },
                  ,
                  {
                   text: "Montant",
                   value: "montant"
                  }

              ],

            clients: [

            ],
            editedIndex: -1,
            editedItem: {
                id: 0,
                nom: '',
                date_create: '',
            },
            defaultItem: {
                id: 0,
                nom: '',
                date_create: '',
            },
            historique_paiement :[]

        }
    },


    methods: {


        show_order_product(item) {
            
          this.historique_paiement =  item.historique_paiement
           this.dialog = true
        },

        editItem(item) {

            window.location.href = window.laravel .url +"/factures_fournisseur/" + item.id + "/edit"
        },

        clicked(value) {
            const index = this.expanded.indexOf(value)



            if (index === -1) {
                this.expanded.push(value)

            } else {
                this.expanded.splice(index, 1)
            }

        },


   



        save() {

            if (this.editedIndex > -1) {
                Object.assign(this.gategorie[this.editedIndex], this.editedItem)
                this.update_gategorie(this.editedItem)

            } else {
                this.gategorie.push(this.editedItem)
            }

            this.close()

        },

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
        paiement(item) {
          
            window.location.href = window.laravel .url +"/paiements/" + item.id 
        }
        ,

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

                        axios.delete(window.laravel.url + '/delete_factures_fournisseur/' + this.selected[i].id)
                            .then(response => {

                   
                                const index = this.clients.indexOf(this.selected[i]);


                            this.clients.splice(index, 1);
                            
                            this.selected = [];
        

                                

                            })
                            .catch(error => {
                          
                                
                            })

                           

                              


                        
                    }
                  




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

        },

        get_data: function() {
          
            axios.get(window.laravel.url + '/get_all_factures_fournisseur/')
                .then(response => {

                    this.clients = response.data.fournisseur;
                  


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