 

         <!-- Begin Page Content -->
         <div class="container-fluid">

             <!-- Page Heading -->
             <h1 class="h3 mb-2 text-gray-800">Tables</h1>
             <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                 For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

             <!-- DataTales Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                 </div>
                 <div class="card-body">
                 <?php if (isset($message)) echo '<div class="alert alert-info">' . $message . '</div>'; ?>

                     <div class="table-responsive">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>Name</th>
                                     <th>Position</th>
                                     <th>Office</th>
                                     <th>Age</th>
                                     <th>Start date</th>
                                     <th>Salary</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php if (isset($record) && is_array($record)) : ?>
                                     <?php foreach ($record as $key => $value) : ?>
                                         <tr>
                                             <th><?= $value->name ?? '-' ?></th>
                                             <th><?= $value->position ?? '-' ?></th>
                                             <th><?= $value->office ?? '-' ?></th>
                                             <th><?= $value->age ?? '-' ?></th>
                                             <th><?= $value->start_date ?? '-' ?></th>
                                             <th><?= $value->salary ?? '-' ?></th>
                                             <th>
                                                 <a href="/admin/table/edit/<?= $value->id ?>" class="btn btn-primary">Edit</a>
                                                 <a href="/admin/table/delete/<?= $value->id ?>" class="btn btn-danger">Delete</a>
                                             </th>
                                         </tr>
                                 <?php endforeach;
                                    endif; ?>
                             </tbody>

                         </table>
                     </div>
                 </div>
             </div>

         </div>
         <!-- /.container-fluid -->
 