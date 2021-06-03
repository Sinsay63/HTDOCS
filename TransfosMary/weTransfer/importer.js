export default {

    delimiter: ';', // global delimiter for CSV split : can be , or ;
    collections: [],

    init: function () {

        // Hide form if not FR
        const activeFR = document.querySelector('.menupop .ab-item span[title="Afficher le contenu dans : Français"]');
        if(!activeFR) document.querySelector('#acf-group_6078079b8f5cb').style.display = 'none';

        const bodyImporter = document.querySelector('body.toplevel_page_custom-imports'); // global div
        if(bodyImporter) {
            this.initSnd(bodyImporter); //  SECTION 2 : PRODUITS
            this.initThird(bodyImporter); // SECTION 3 : CATEGORES
        }
    },

    initThird: function (bodyImporter) {
        const self = this;
        const divCSV = bodyImporter.querySelector('div[data-name=import_csv_third'); // div where file is stored
        if(divCSV) {
            const fileUrl = divCSV.querySelector('a[data-name=filename]').href; // selector of file url location
            const btnCSV = bodyImporter.querySelector('#processcsvthird'); // btn to init process
            if(fileUrl && btnCSV) {
                btnCSV.addEventListener('click', (e) => {
                    self.executeRequestFile('third',fileUrl,'#processcsvthird'); // Call File process to array
                    event.preventDefault(); // cancel click and submit
                    return false;
                });
            }
        }
    },

    initSnd: function (bodyImporter) {
        const self = this;
        const divCSV = bodyImporter.querySelector('div[data-name=import_csv_snd'); // div where file is stored
        if(divCSV) {
            const fileUrl = divCSV.querySelector('a[data-name=filename]').href; // selector of file url location
            const btnCSV = bodyImporter.querySelector('#processcsvsnd'); // btn to init process
            if(fileUrl && btnCSV) {
                btnCSV.addEventListener('click', (e) => {
                    self.executeRequestFile('snd',fileUrl,'#processcsvsnd'); // Call File process to array
                    event.preventDefault(); // cancel click and submit
                    return false;
                });
            }

            // Delete Button Process
            const suppBtn = document.querySelector('button#cleansnd');
            suppBtn.addEventListener('click', (e) => {
                const idsStr = suppBtn.getAttribute('data-ids');
                suppBtn.style = 'opacity: 0.5;pointer-events: none;';
                self.executePostsSuppression('product','snd',idsStr);
                event.preventDefault(); // cancel click and submit
                return false;
            });
        }
    },

    /**
     * Execute Request to retrieve data from csv url
     *
     * @param {string} indic
     * @param {string} url
     * @param {string} btn
     */
    executeRequestFile: function (indic, url, btn) {
        const self = this;
        var request = new XMLHttpRequest(); // request to fetch csv file
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                self.parseTextIntoData(indic, request.responseText, btn); // if success call parse function
            }
        };
        request.open('GET', url, true);
        request.send(null);
    },

    /**
     * Process to transform string csv to array of data with colons as keys
     *
     * @param {string} indic
     * @param {string} data
     * @param {string} btn
     */
    parseTextIntoData: function (indic, data, btn) {
        // console.log("String",data); // full string data retrieved
        let allRows = data.split(this.delimiter+'END\n'); // split text to global array delimited by end of line // Ex: ["id,name,age"],["1,louis,25"],...
        allRows = allRows.filter(function (el) { // filter useless lines where ther is no data but only "" empty string
            return el !== "";
        });
        // console.log("allRows Filter",allRows);

        allRows = allRows.map(row => { // split the latest array to new array by cells with delimiter chosen ["id","name","age"],["1","louis","25"],...
            return row.split(this.delimiter);
        });
        // console.log("allRows Split",allRows);

        let cols = allRows.shift(); // remove 1st line array which must be colons names
        // console.log("Columns",cols);

        let collection = [];
        for (var k in allRows) { // build new array with key as colon defining value
            let newItem = {};
            for (let i in allRows[k]) {
                newItem[cols[i]] = allRows[k][i];
            }
            collection.push(newItem);
        }
        this.collections[indic] = collection;
        console.log("Collections",this.collections);

        this.importType(indic,btn)
    },

    /**
     * Example function to start data treatment for one specific data type
     *
     * @param {string} indic
     * @param {string} btn
     */
    importType: function (indic,btn) {
        if(this.collections[indic].length > 0) {
            const btnCSV = document.querySelector('button'+btn);
            btnCSV.style = 'opacity: 0.5;pointer-events: none;';

            const indicator = document.querySelector('.indic-custom-'+indic);
            indicator.classList.remove('hide');

            const max = indicator.querySelector('.max');
            max.textContent = this.collections[indic].length;

            const line = document.querySelector('.line-'+indic);
            line.classList.remove('hide');

            this.executeDataProcess(1, indic);

        }
    },

    executePostsSuppression(type, indic, ids) {
        const self = this;
        (function( $ ) {
            $.ajax({
                url : adminAjax.ajaxUrl,
                data : {
                    action: 'deletePosts',
                    indic : indic,
                    type : type,
                    d: ids
                },
                method : 'POST', //Post method
                success : function( response ){
                    let resp = JSON.parse(response);
                    console.log(resp);
                    if(resp && resp.success === true) {
                        const suppList = document.querySelector('ul#deleteposts'+indic);
                        suppList.classList.add('show');
                        const suppBtn = document.querySelector('button#clean'+indic);
                        if(suppBtn) {
                            suppBtn.classList.remove('show');
                            suppBtn.setAttribute('data-ids','');
                        }
                        console.log(resp.posts);
                        const li = document.createElement("li");
                        if(resp.posts && resp.posts.length > 0) {
                            li.classList.add('title');
                            li.appendChild(document.createTextNode("Liste des éléments supprimés"));
                            suppList.appendChild(li);
                            resp.posts.forEach(item => {
                                const litem = document.createElement("li");
                                litem.appendChild(document.createTextNode(item));
                                suppList.appendChild(litem);
                            })
                        } else {
                            li.classList.add('none');
                            li.appendChild(document.createTextNode("Aucun élément supprimé"));
                            suppList.appendChild(li);
                        }
                    } else {
                        console.log("ERROR",response);
                    }
                },
                error : function(error){ console.log(error) }
            })
        })(jQuery)
    },

    executeDataProcess: function (i, indic) {
        const self = this;
        let ids = [];
        (function( $ ) {
            $.ajax({
                url : adminAjax.ajaxUrl,
                data : {
                    action : indic,
                    index : i,
                    max: self.collections[indic].length,
                    d: JSON.stringify(self.collections[indic][i-1])
                },
                method : 'POST', //Post method
                success : function( response ){
                    let resp = JSON.parse(response);
                    if(resp && resp.success === true) {

                        const indicator = document.querySelector('.indic-custom-'+indic+' .indic');
                        indicator.innerHTML = resp.index;

                        const percent = document.querySelector('.line-'+indic+' .percent');
                        percent.style = 'width: calc(('+resp.index+'/'+resp.max+')*100%);';

                        console.log(resp);
                        ids.push(resp.id_fr);
                        ids.push(resp.id_en);
                        const suppBtn = document.querySelector('button#clean'+indic);
                        if(ids.length > 0) {
                            if(suppBtn){
                                const base = (suppBtn.getAttribute('data-ids') === null) ? "" : suppBtn.getAttribute('data-ids')+',';
                                suppBtn.setAttribute('data-ids',base+ids.join());
                                console.log(suppBtn.getAttribute('data-ids'));
                            }
                        }
                        if(Number(resp.index) < Number(resp.max)) {
                            self.executeDataProcess(Number(resp.index)+1, indic);
                        } else {
                            console.log('DONE !');
                            if(suppBtn) suppBtn.classList.add('show');
                        }
                    } else {
                        console.log("ERROR",response);
                    }
                },
                error : function(error){ console.log(error) }
            })
        })(jQuery)
    }
}
