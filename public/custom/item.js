$("#create_item_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type : 'POST',
        data: formData,
        url  : '/master/item/store',
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            swal.showLoading();
        },
        success: function(data){
            swal.hideLoading();
            if(data.status === true) {
                swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() {
                    location.reload()
                });
            }else {
                var values = '';
                jQuery.each(data.message, function (key, value) {
                    values += value+"<br>";
                });

                swal.fire({
                    html: values,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() { });
            }
        }
    });
});

$("#update_item_form").on("submit", function (event) {
    event.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type : 'POST',
        data: formData,
        url  : '/master/item/update',
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            swal.showLoading();
        },
        success: function(data){
            swal.hideLoading()
            if(data.status === true) {
                swal.fire({
                    text: data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() {
                    location.reload()
                });
            }else {
                var values = '';
                jQuery.each(data.message, function (key, value) {
                    values += value+"<br>";
                });

                swal.fire({
                    html: values,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() { });
            }
        }
    });
});

var KTDatatablesDataSourceAjaxType = function() {
    var parts = location.href.split('/');
    var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash
    
	var initTable1 = function() {
		var table = $('#kt_datatable');

		// begin first table
		table.DataTable({
            order: [0, 'desc'],
			responsive: true,
			ajax: {
				url: '/master/item/data',
				type: 'GET',
				data: {
					pagination: {
						perpage: 20,
					},
                    filter: lastSegment
				},
			},
			columns: [
				{data: 'id'},
				{data: 'item'},
				{data: 'checklist'},
				{data: 'type'},
				{data: 'created_at'},
				{data: 'id', responsivePriority: -1},
			],
			columnDefs: [
                {
                    targets: 0,
                    class: 'text-left',
					render: function(data, type, full, meta) {
                        return '';
					},
				},
				{
                    targets: 1,
                    class: 'text-left',
                    render: function (data, type, full, meta) {
                        return '<a href="/master/item/edit/'+full.id+'">'+data+'</a>'
                    }
				},
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
                    class: 'remove-client',
					render: function(data, type, full, meta) {
						return `<a class="nav-link delete-btn" onclick="deleteData(${full.id})" href="#" data-toggle="modal" data-target="#deleteModal" data-id="${full.id}">
                            <i class="nav-icon la la-trash"></i><span class="nav-text"></span>
                        </a>`;
					},
				},
				{
					width: '200px',
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

function deleteData(id)
{
    $('#confirmDelete').attr('href', '/master/item/destroy/' + id);
}

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
	KTDatatablesDataSourceAjaxType.init();
});