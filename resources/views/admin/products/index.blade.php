<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Arch & Sun Designs</title>
    <link rel="shortcut icon" href="/images/logo.png">
    <title>Title</title>
    <link type="text/css"
          rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<div class="col-xs-12 col-sm-offset-2 col-sm-8">
    <form method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <fieldset class="form-group col-sm-12">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
        </fieldset>
        <fieldset class="form-group col-sm-12" id="gender">
            <label for="gender">Gender</label>
            <div class="radio-inline">
                <label class="radio-inline">
                    <input type="radio" name="gender" id="gender1" value="M">
                    Men
                </label>
            </div>
            <div class="radio-inline">
                <label class="radio-inline">
                    <input type="radio" name="gender" id="gender2" value="F">
                    Women
                </label>
            </div>
        </fieldset>
        <fieldset class="form-group col-sm-6">
            <label for="category">Choose the Category</label>
            <select class="form-control" id="category" name="category">
                <option>Select a Gender First</option>
            </select>
        </fieldset>
        <fieldset class="form-group col-sm-6">
            <label for="subcategory">Subcategory</label>
            <select class="form-control" id="subcategory" name="subcategory">
                <option>Select a Category First</option>
            </select>
        </fieldset>
        <fieldset class="form-group col-sm-12">
            <label for="colors">Colors</label>
            <select multiple class="form-control" id="colors" name="colors[]">
                <option>Blue</option>
                <option>Red</option>
                <option>Yellow</option>
                <option>Green</option>
                <option>Pink</option>
                <option>Black</option>
                <option>White</option>
            </select>
        </fieldset>
        <fieldset class="form-group col-sm-12">
            <label for="specs">Specifications</label>
            <textarea class="form-control" id="specs" name="specs" rows="3"></textarea>
        </fieldset>
        <fieldset class="form-group  col-sm-6">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price">
        </fieldset>
        <fieldset class="form-group  col-sm-6">
            <label for="clearance">Clearance Price</label>
            <input type="text" class="form-control" id="clearance" name="clearance" placeholder="Clearance Price">
        </fieldset>
        <fieldset class="form-group  col-sm-12">
            <label for="pictures">Pictures</label>
            <input type="file" name="pictures[]" class="form-control-file" id="pictures" multiple>
            <small class="text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
        </fieldset>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var categories;
    var gender;
    var category;

    $(document).ready(function() {
        $.getJSON('/api/v1/category', function(data) {
            console.log(data);
            categories = data;
        });
    });

    $('#gender input').on('change', function() {
        gender = $('input[name=gender]:checked', '#gender').val();
        var prefix = (gender == 'M') ? "Men's " : "Women's ";
        var options = $("#category");
        options.find('option').remove().end();
        $("#subcategory").find('option').remove().end().append($("<option />").text("Select a Category First"));
        $.each(categories[gender], function() {
            options.append($("<option />").val(this.id).text(prefix + this.name));
        });
    });

    $('#category').on('change', function() {
        category = $('#category option:selected').val();
        var options = $("#subcategory");
        options.find('option').remove().end();
        $.each(categories[gender][category]['subcategories'], function() {
            options.append($("<option />").val(this.id).text(this.name));
        });
    });

</script>
</body>
</html>