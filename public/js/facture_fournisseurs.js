new Vue({
    el: '#app_client',
    vuetify: new Vuetify(),

    data() {

        return {
  

            date: new Date().toISOString().substr(0, 10),
              menu: false,
              modal: false,
              menu2: false,
            dialog1: false,
            dialog: false,
            dialog2: false,
            dialog3: false,
            valid: true,
            notifications: false,
            expanded: [],
            singleExpand: true,
            pagination: {
                rowsPerPage: 5,

            },
            dialog_edit_payment : false,
            btn_control: false,
            singleSelect: false,
            selectedRows: [],
            selected: [],
            search: '',
            sortBy: 'id',
            sortDesc: true,
            payment_current:'',
            defaultItem: {
                id: 0,
                mode_paiement: '',
                n_cheque: '',
                date_cheque: new Date().toISOString().substr(0, 10),
                montant: '',
                etat_paiement: '',
              },
              
            headers: [

              
                {
                    text: 'Numero',
                    value: 'id'
                }
                ,
                
                {
                    text: "Fournisseur nom",
                    value: "fournisseur_nom",
                    sortable: false
                }
                
                ,
                
                {
                    text: "Numero facture",
                    value: "numero_facture",
                    sortable: false
                }
                ,
                {
                    text: 'Etat paiement',
                    value: 'etat_paiement'
                },
               
                {
                    text: "Paiement",
                    value: "paiement_facture",
                    sortable: false
                }
                ,
                
                {
                    text: "Total TTC",
                    value: "total_ttc",
                    sortable: false
                }
                ,
                
                
                {
                    text: "Total payé",
                    value: "total_paye",
                    sortable: false
                }
                ,
                {
                    text: "Action",
                    value: "action",
                    sortable: false
                }



            ],

            subHeaders: [  
                {
                    text: "Id",
                    align: "left",
                    sortable: false,
                    value: "id"
                },
                {
                 text: "Mode paiement",
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
                  ,
                  {
                   text: "Etat de paiement",
                   value: "etat_paiement"
                  },
                  { title: 'Actions', value: 'actions', sortable: false },

              ],

            all_paiements: [

            ],
            editedIndex: -1,
            editedItem: {
                id: 0,
                mode_paiement: '',
                n_cheque: '',
                date_cheque: new Date().toISOString().substr(0, 10),
                montant: '',
                etat_paiement: '',
              },
            historique_paiement :[]

        }
    },


    computed: {
        computedDateFormatted () {
          return this.formatDate(this.defaultItem.date_cheque)
        }
      },
  
      watch: {
        date (val) {
          this.dateFormatted = this.formatDate(this.defaultItem.date_cheque)
        }
      },


    methods: {


        edit_Item_paiement(item){
            this.editedItem = item

            this.dialog2=true
                },


        formatDate (date) {
            if (!date) return null
    
            const [year, month, day] = date.split('-')
            return `${month}/${day}/${year}`
          },
          parseDate (date) {
            if (!date) return null
    
            const [month, day, year] = date.split('/')
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
          },


        show_order_product(item) {
            
          this.historique_paiement =  item.historique_paiement;
          this.payment_current = item.id;
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

        update_item_payment: function(item_object) {

       
          
            axios.post(window.laravel.url + '/updatepaiements/'+ this.editedItem.id , this.editedItem)
                .then(response => {
                    console.log(response.data);

                })
                .catch(error => {
                    console.log(error);
                })


                this.close()

        },


        save_item_payment() {

            if (this.editedIndex > -1) {
                Object.assign(this.all_paiements[this.editedIndex], this.editedItem)
                this.update_item_payment(this.editedItem)

            } else {
                this.all_paiements.push(this.editedItem)
            }

            this.close()

        },


        submitFiles()  {



           if(this.defaultItem.mode_paiement != ''  && this.defaultItem.date_cheque != ''
            && this.defaultItem.montant != '' && this.defaultItem.etat_paiement != '' ) {

                
                let jsonData = new FormData()
                jsonData.append('facture_fournisseur_id'        , this.payment_current )
                jsonData.append('mode_paiement'        , this.defaultItem.mode_paiement )
                jsonData.append('n_cheque', this.defaultItem.n_cheque )
                jsonData.append('date_cheque'        , this.defaultItem.date_cheque )
                jsonData.append('montant', this.defaultItem.montant )
                jsonData.append('etat_paiement', this.defaultItem.etat_paiement )



                axios.post(window.laravel.url + '/paiements/store', jsonData)
                .then(response => {


                    if (response.data.status == 400) {

                        alert('vous avez depassez le montant de la facture ')
                   
                    }
                    if (response.data.status == 500) {

                        alert('le solde de la Caisse est insuffisant')
                   
                    }


                    if (response.data.etat) {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Ajouté avec succes'
                        })
                     
                        this.defaultItem.id = response.data.id_historique_paiement;
                        this.historique_paiement.unshift(this.defaultItem);

                        this.defaultItem = {
                            mode_paiement   : '',
                            n_cheque        : '',
                            date_cheque     : '',
                            montant         : '',
                            etat_paiement   : '',
             
                        };

                    }


                })

               

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

        editItem_payment (item) {
            // this.editedIndex = this.desserts.indexOf(item)
            // this.editedItem = Object.assign({}, item)
            
            this.dialog_edit_payment = true
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

        deleteItem_paiement(item_id) {

           
            
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

                   

                        axios.delete(window.laravel.url + '/deletepaiements/' + item_id)
                            .then(response => {

                   
                                const index = this.historique_paiement.indexOf(item_id);


                            this.historique_paiement.splice(index, 1);
                            
                           
        

                                

                            })
                            .catch(error => {
                          
                                
                            })

                           

                              


          




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

                   
                                const index = this.all_paiements.indexOf(this.selected[i]);


                            this.all_paiements.splice(index, 1);
                            
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
          
            axios.get(window.laravel.url + '/getfactures_fournisseur/'+ window.laravel.id_facture_fournisseurs)
                .then(response => {

                    this.all_paiements = response.data.fournisseur;
                  


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