var collections = [];

function init() {
    console.log('**********');
    const bodyImporter = document.querySelector('body.toplevel_page_acf-options-base-de-donnees'); // global div
    if(bodyImporter) {

        initFirst(bodyImporter);

    }
}

function initFirst(bodyImporter) {
    const self = this;
    const divCSV = bodyImporter.querySelector('div[data-name=base_de_donnees'); // div where file is stored
    if(divCSV) {
        const fileUrl = divCSV.querySelector('a[data-name=filename]').href; // selector of file url location
        const btnCSV = bodyImporter.querySelector('#processcsv'); // btn to init process
        if(fileUrl && btnCSV) {
            btnCSV.addEventListener('click', (e) => {
                self.executeRequestFile('first',fileUrl,'#processcsv'); // Call File process to array
                event.preventDefault(); // cancel click and submit
                return false;
            });
        }
    }
}

/**
 * Execute Request to retrieve data from csv url
 *
 * @param {string} indic
 * @param {string} url
 * @param {string} btn
 */
function executeRequestFile(indic, url, btn) {
    const self = this;
    var request = new XMLHttpRequest(); // request to fetch csv file
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            self.parseTextIntoData(indic, request.responseText, btn); // if success call parse function
        }
    };
    request.open('GET', url, true);
    request.send(null);
}

function chunkArray(myArray, chunk_size){
    var index = 0;
    var arrayLength = myArray.length;
    var tempArray = [];
    
    for (index = 0; index < arrayLength; index += chunk_size) {
        myChunk = myArray.slice(index, index+chunk_size);
        tempArray.push(myChunk);
    }

    return tempArray;
}

/**
 * Process to transform string csv to array of data with colons as keys
 *
 * @param {string} indic
 * @param {string} data
 * @param {string} btn
 */
var collections = [];
function parseTextIntoData(indic, data, btn) {
    //var tempData = data;
    let allRows = chunkArray(data.split(';'), 100); // split text to global array delimited by end of line // Ex: ["id,name,age"],["1,louis,25"],...
    allRows = allRows.filter(function (el) { // filter useless lines where ther is no data but only "" empty string
        return el !== "";
    });

    let cols = allRows.shift(); // remove first line array which must be colons names
    allRows.pop();
    console.log(allRows);

    //console.log(cols);

    let collection = [];
    for (var k in allRows) { // build new array with key as colon defining value
        let newItem = {};
        for (let i in allRows[k]) {
            var newKey = cols[i].replace('\n', '').replace('\\', '').replace(/["]+/g,'');
            var newValue = allRows[k][i].replace('\n', '').replace('\\', '').replace(/["]+/g,'');
            newItem[newKey] = newValue;
        }
        //console.log("++++",newItem);
        collection.push(newItem);
    }
    collections[indic] = collection;
    console.log("collections",collections);

    importType(indic,btn);
}

/**
 * Example function to start data treatment for one specific data type
 *
 * @param {string} indic
 * @param {string} btn
 */
function importType(indic,btn) {
    if(collections[indic].length > 0) {
        const btnCSV = document.querySelector('button'+btn);
        btnCSV.style = 'opacity: 0.5;pointer-events: none;';

        const indicator = document.querySelector('.indic-custom-'+indic);
        indicator.classList.remove('hide');

        const max = indicator.querySelector('.max');
        max.textContent = collections[indic].length;

        const line = document.querySelector('.line-'+indic);
        line.classList.remove('hide');

        executeDataProcess(1, indic);

    }
}

function executeDataProcess(i, indic) {
    const self = this;
    //console.log("i : ", i);
    //console.log("indic : ", indic);
    //console.log("self : ", self);
    //console.log("max : ", self.collections[indic].length);
    //console.log("d : ", self.collections[indic][i-1]);
    (function( $ ) {
        $.ajax({
            url : adminAjax.ajaxUrl,
            data : {
                action : indic,
                index : i,
                max: self.collections[indic].length,
                d: self.collections[indic][i-1]
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
                    if(Number(resp.index) < Number(resp.max)) {
                        self.executeDataProcess(Number(resp.index)+1, indic);
                    } else {
                        console.log('DONE !')
                    }
                } else {
                    console.log("ERROR",response);
                }
            },
            error : function(error){ console.log(error) }
        })
    })(jQuery)
}


init();