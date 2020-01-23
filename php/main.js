$(".btnedit").click(e=>{
let textvalues=displayData(e);

let id=$("input[name*='book_id']");//select the textboxes using name attribute
let bookname=$("input[name*='book_name']");
let bookpublisher=$("input[name*='book_publisher']");
let bookprice=$("input[name*='book_price']");
id.val(textvalues[0]);
bookname.val(textvalues[1]);
bookpublisher.val(textvalues[2]);
bookprice.val(textvalues[3].replace("$",""));//replace is used to remove dollar symbol in text box

});

function displayData(e)
{
    let id=0;
    const td=$("#tbody tr td");
    let textvalues=[];
    for(const value of td)
    {
        if(value.dataset.id == e.target.dataset.id)
//return the sid of datasets  
      {
            textvalues[id++]=value.textContent;
        }

    }
    return textvalues;
}