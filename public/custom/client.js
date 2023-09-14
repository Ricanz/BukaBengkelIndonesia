'use strict';
var KTDatatablesDataSourceAjaxClient = function() {

	var initTable1 = function() {
		var table = $('#kt_datatable');

		// begin first table
		table.DataTable({
			responsive: true,
			ajax: {
				url: '/client/data',
				type: 'GET',
				data: {
					pagination: {
						perpage: 20,
					},
				},
			},
			columns: [
				{data: 'id'},
				{data: 'image'},
				{data: 'title'},
				{data: 'status'},
				{data: 'created_at'},
				{data: 'id', responsivePriority: -1},
			],
			columnDefs: [
				{
                    targets: 1,
					width: '150px',
                    class: 'text-center',
					render: function(data, type, full, meta) {
                        return `<img alt="Logo" src=${data}" class="max-h-35px" />`
					},
				},
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
							<div class="dropdown dropdown-inline">
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-trash"></i><span class="nav-text">Delete</span></a></li>
									</ul>
							  	</div>
							</div>
						`;
					},
				},
				{
					width: '75px',
					targets: -3,
					render: function(data, type, full, meta) {
						var status = {
							"active": {'title': 'Active', 'class': 'label-light-success'},
							"deleted": {'title': 'Deleted', 'class': ' label-light-danger'},
							"inactive": {'title': 'Inactive', 'class': ' label-light-warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-lg font-weight-bold ' + status[data].class + ' label-inline">' + status[data].title + '</span>';
					},
				},

				{
					targets: -2,
					render: function(data, type, full, meta) {
                        return to_date_time(data)
					},
				},
			],
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

function to_date_time(date) {
    let tanggal = new Date(date);
    return tanggal.getFullYear()+"-"
        + (tanggal.getMonth()+ 1 > 9 ? (tanggal.getMonth()+ 1).toString() : "0" + (tanggal.getMonth()+ 1).toString())
        +"-"
        +(tanggal.getDate() > 9 ? tanggal.getDate().toString() : "0" + tanggal.getDate().toString())
        + " "
        +(tanggal.getHours().toString() > 9 ? tanggal.getHours().toString() : "0" + tanggal.getHours().toString())
        + ":" + (tanggal.getUTCMinutes().toString() > 9 ? tanggal.getUTCMinutes().toString() : "0" + tanggal.getUTCMinutes().toString())
        + ":" + (tanggal.getUTCSeconds().toString() > 9 ? tanggal.getUTCSeconds().toString() : "0" + tanggal.getUTCSeconds().toString());
}

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxClient.init();
});
