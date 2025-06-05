<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr>
<div class="row">
        <div class="col-12 col-sm-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-th-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Courses</span>
                <span class="info-box-number">
                  <?php 
                    $course = $conn->query("SELECT * FROM course_list where delete_flag = 0")->num_rows;
                    echo format_num($course);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Classes</span>
                <span class="info-box-number">
                  <?php 
                    $class = $conn->query("SELECT * FROM class_list where delete_flag = 0 ")->num_rows;
                    echo format_num($class);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Question Paper List</span>
                <span class="info-box-number">
                  <?php 
                    $qp = $conn->query("SELECT * FROM question_paper_list where delete_flag = 0 ")->num_rows;
                    echo format_num($qp);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Users</span>
                <span class="info-box-number">
                  <?php 
                    $ruser = $conn->query("SELECT * FROM registered_user_list where delete_flag = 0 ")->num_rows;
                    echo format_num($ruser);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
        </div>

