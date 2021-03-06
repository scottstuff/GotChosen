/*
 * show_one_post_json.js
 */
$(document).ready(function(){
    $("#show_post").append('Please wait...');
    var div_start = '<div class="row form-group"><label class="col-xs-2 required">';
    var div_mid = '</label><div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" value="';
    var div_mid_body = '</label><div class="col-xs-4"><textarea class="form-control" disabled="disabled">';
    var div_end = '"/></div>';
    var div_end_body = '</textarea></div>';
    
    $.getJSON('getJSON/{{ id }}', function(data) {
        $("#show_post").empty();
        $("#show_post").append(div_start + 'Record ID' + div_mid + data.id + div_end);
        $("#show_post").append(div_start + 'Post Title' + div_mid + data.postTitle + div_end);
        $("#show_post").append(div_start + 'Post Body' + div_mid_body + data.postBody + div_end_body);
        $("#show_post").append(div_start + 'First Name' + div_mid + data.poster.firstName + div_end);
        $("#show_post").append(div_start + 'Last Last' + div_mid + data.poster.lastName + div_end);
        $("#show_post").append(div_start + 'Created' + div_mid + data.createdAt.date + div_end);
        
        $.each(data.tags, function(i, field) {
            $("#show_post").append(div_start + 'Tag'+ (i + 1) + div_mid + field + div_end);
        });
        $("#show_post").append('<br><a href="../show">Back to Posts</a>');
    });
});
