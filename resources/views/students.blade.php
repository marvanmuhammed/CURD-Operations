<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax CURD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>


    <!-- StudentCard -->


        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="success_messages"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Students Data
                            <a href="#" class="btn btn-primary float-end btn sm" data-bs-toggle="modal" data-bs-target="#AddStudentModal">Add Student</a>
                        </h4>
                    </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table">
                                <thead>
                                  <tr style="background-color :antiquewhite">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" colspan="2" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                              </table>
                          </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>

  
  <!-- AddStudentModal -->


  <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">New Student</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="">Student Name</label>
            <input type="text" class="name form-control">
            <label for="">Course</label>
            <input type="text" class="course form-control">
            <label for="">Phone</label>
            <input type="number" class="phone form-control">
            <label for="">Email</label>
            <input type="email" class="email form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_student">SAVE</button>
        </div>
      </div>
    </div>
  </div>
</body>

 <!-- EditStudentModal -->


 <div class="modal fade" id="EditStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="studentID"></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
          <label for="">Student Name</label>
          <input type="text" id="edit_name" class="name form-control">
          <label for="">Course</label>
          <input type="text" id="edit_course" class="course form-control">
          <label for="">Phone</label>
          <input type="number" id="edit_phone" class="phone form-control">
          <label for="">Email</label>
          <input type="email" id="edit_email" class="email form-control">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button"  class="btn btn-primary update_student">UPDATE</button>
      </div>
    </div>
  </div>
</div>
</body>


<!-- DeleteStudentModal -->


<div class="modal fade" id="DeleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 id="deleteStudentID">Are you sure?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button"  class="btn btn-danger deleteStudent">DELETE</button>
      </div>
    </div>
  </div>
</div>
</body>


 <!-- Ajax -->

<script>

    $(document).ready(function(){

                            //fetching table data


        fetch();

        function fetch(){
            $.ajax({
                type:"GET",
                url:"/fetch_data",
                dataType:"json",
                success: function(response){
                    //console.log(response.students);
                    $('tbody').html("");
                    $.each(response.students,function(key,datas){
                        $('tbody').append(
                            '<tr>\
                                    <td>'+datas.id+'</td>\
                                    <td>'+datas.name+'</td>\
                                    <td>'+datas.course+'</td>\
                                    <td>'+datas.phone+'</td>\
                                    <td>'+datas.email+'</td>\
                                    <td class="text-center"><button type="button" value="'+datas.id+'" class="edit_student btn btn-primary btn-sm">Edit</button></td>\
                                    <td><button type="button" value="'+datas.id+'" class="delete_student btn btn-danger btn-sm">Delete</button></td>\
                                  </tr>'
                        );
                    });
                    $('.add_student').text("SAVE");
                    $('.update_student').text("UPDATE");
                    $('.deleteStudent').text("DELETE");
                }
        });
        
        }


                            //update the data



      $(document).on('click','.update_student',function(e){

            e.preventDefault();
            $('.update_student').text("Updating...")
            var data={
            'id' : $('#studentID').val(),
            'name' : $('#edit_name').val(),
            'email' : $('#edit_email').val(),
            'course' : $('#edit_course').val(),
            'phone' : $('#edit_phone').val(),
          }
          console.log(data);
          $.ajaxSetup({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              type:'PUT',
              url:"/update-student",
              data: data,
              dataType:"json",
              success: function (response) {
                //console.log(response.data);
                 //console.log(response.message);
                    $("#success_messages").addClass('alert alert-success')
                    $("#success_messages").text(response.message)
                    $("#EditStudentModal").modal('hide');
                    $("#EditStudentModal").find('input').val("");
                    $("#success_messages").fadeIn(1000);
                    fetch();
                    $("#success_messages").fadeOut(3000);

              }
            })

      });




                                //edit the data


      
      $(document).on('click','.edit_student',function(e){

        e.preventDefault();
        var student_id = $(this).val();
        //console.log(student_id);
        $('#EditStudentModal').modal('show');
        $('#studentID').val(+student_id);
        $('#studentID').text("Student ID: "+student_id);


        $.ajax({
                type:"GET",
                url:"/fetch_dataedit/"+student_id,
                success: function(response){
                   // console.log(response.students);
                    $('#edit_name').val(response.students.name);
                    $('#edit_email').val(response.students.email);
                    $('#edit_course').val(response.students.course);
                    $('#edit_phone').val(response.students.phone);
                  }
                });       

      });


                        //Delete the Data 


      $(document).on('click','.delete_student',function(e){

        e.preventDefault();
        var id = $(this).val();
        //console.log(id);
        $('#DeleteStudentModal').modal('show');
        $('#deleteStudentID').val(+id);
      })

      $(document).on('click','.deleteStudent',function(e){
      
        e.preventDefault();
        $('.deleteStudent').text("Deleting...");
        var id = $('#deleteStudentID').val();
        //console.log(id);

        $.ajaxSetup({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
                type:"DELETE",
                url:"/delete-student/"+id,
                success: function(response){
                  //  console.log(response.message);
                  $("#success_messages").addClass('alert alert-success')
                    $("#success_messages").text(response.message)
                    $("#DeleteStudentModal").modal('hide');
                    $("#DeleteStudentModal").find('input').val("");
                    $("#success_messages").fadeIn(1000);
                    fetch();
                    $("#success_messages").fadeOut(3000);

                  }
                }); 
        

      });





                        //inserting into database


        
        $(document).on('click','.add_student', function(e){
            e.preventDefault();
            $('.add_student').text("Saving");
            //console.log("hey");
            var data = { 
                'name' : $('.name').val(),
                'course' : $('.course').val(),
                'email' : $('.email').val(),
                'phone' : $('.phone').val(),
            }
            //console.log(data);
            $.ajaxSetup({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url:"/students",
                data:data,
                dataType:"json",
                success: function(response){
                    //console.log(response.message);
                    $("#success_messages").addClass('alert alert-success');
                    $("#success_messages").text(response.message);
                    $("#AddStudentModal").modal('hide');
                    $("#AddStudentModal").find('input').val("");
                    $("#success_messages").fadeIn(1000);
                    fetch();
                    $("#success_messages").fadeOut(3000);

                }
            });
        });
    });
</script>