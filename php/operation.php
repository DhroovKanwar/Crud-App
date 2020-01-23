<?php

require_once("db.php");
require_once("component.php");

$con=Createdb();

//create button click

if(isset($_POST['create']))
{
    createData();
}
if(isset($_POST['update']))
{
    UpdateData();
}

if(isset($_POST['delete']))
{
    deleteRecord();
}

if(isset($_POST['deleteall']))
{
    deleteAll();
}
function createData()
{
    $bookname=textboxValue("book_name");
    $bookpublisher=textboxValue("book_publisher");
    $bookprice=textboxValue("book_price");

    if($bookname && $bookpublisher && $bookprice)
    {
        $query="INSERT INTO books(book_name,book_publisher,book_price)
        VALUES('$bookname','$bookpublisher','$bookprice')";

        if(mysqli_query($GLOBALS['con'],$query))
        {
            //echo "Record added Successfully";
            TextNode("success","Record inserted Successfully");
        }
        else
        {
            echo "Error ";
        }
    }
    else
    {
        TextNode("error","Provide data in TextBoxes");
    }
}

function textboxValue($value)
{
    $textbox=mysqli_real_escape_string($GLOBALS['con'],trim($_POST[$value]));  
//It removes special character used in sql statement
if(empty($textbox))
{
    return false;
}
else
{
    return $textbox;
}
}

//messages

function TextNode($classname,$msg)//classname and parameter
{
    $element="<h6 class='$classname'>$msg</h6>";

    echo $element;
}

//get data from the database
function getData()
{
    $query="SELECT * FROM books";

    $result=mysqli_query($GLOBALS['con'],$query);//in result it will return values

    if(mysqli_num_rows($result)>0)
    {
        return $result;

    }

}

//update data

function UpdateData()
{//get values into variables for textbox

    $bookid=textboxValue("book_id");
    $bookname=textboxValue("book_name");
    $bookpublisher=textboxValue("book_publisher");
    $bookprice=textboxValue("book_price");
    if($bookname && $bookpublisher && $bookprice)
    {
        $query="
        UPDATE books SET book_name='$bookname',book_publisher='$bookpublisher',book_price='$bookprice' WHERE id='$bookid';

        ";

        if(mysqli_query($GLOBALS['con'],$query))
        {
            TextNode("success","Record updated Successfully");

        }
        else
        {
            TextNode("error","Enable to update data");
        }
    }
    else
    {
        TextNode("error","Select Data using Edit Icon");
    }

}

//deleting the record

function deleteRecord()
{
    $bookid=(int)textboxValue("book_id");//textbox always returns strings

    $query="DELETE FROM books WHERE id=$bookid";
    
    if(mysqli_query($GLOBALS['con'],$query))
    {
        TextNode("success","Record Deleted Successfully.....");

    }
    else
    {
        TextNode("error","Enable to Delete Record....");
    }
}

function deleteBtn()
{
    $result=getData();
    $i=0;

    if($result)
    {
        while($row=mysqli_fetch_assoc($result))
        $i++;
        if($i>3)
        {
            buttonElement("btn-deleteall","btn btn-danger","<i class='fas fa-trash'></i>Delete ALL","deleteall","");
            return;
        }
    }
     
}

function deleteAll()
{
    $query="DROP TABLE books";
    if(mysqli_query($GLOBALS['con'],$query))
    {
        TextNode("success","All Records deleted Successfully....!");
        Createdb();//to make the table again

    }
    else
    {
        TextNode("error","Something Went Wrong Records cannot deleted");
    }
}