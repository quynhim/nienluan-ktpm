@extends('qldatphong_home')

@section('title', 'Tất Cả Lượt Đặt Phòng')

@section('table')
<script type="text/javascript">
    //Bắt sự kiện khi bấm button chỉnh sửa
    $(document).ready(function(){
        $(".btnChinhSua").click(function(){
            var url = "http://localhost/nienluan-ktpm/quanli/chinhsuadatphong"
            var mact = $(this).closest('tr').find('td:first').text();
            //alert(mact) ;
           
           $.ajax({
                url : url,
                type : "GET",
                dataType : "JSON",
                data : {'mact':mact},
                success : function(result){
                    if(result.success){
                        location = "http://localhost/nienluan-ktpm/quanli/qldatphong/chitietdatphong";
                    }
                }
           });    
        });
    });
</script>


    <h2>Tất Cả Lượt Đặt Phòng</h2> 
    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="tbLuotDatPhong">
            <thead>
                <tr>
                    <th>Mã ĐP</th>
                    <th>Tên khách hàng</th>
                    <th>SĐT</th>
                    <th>Người lớn</th>
                    <th>Trẻ em</th>
                    <th>Loại phòng</th>
                    <th>Phòng</th>
                    <th>Ngày đặt</th>
                    <th>Ngày nhận</th>
                    <th>Ngày trả</th>
                    <th>Xác nhận</th>
                </tr>
            </thead>
            <tbody>
                @if($num_all == 0)
                    <tr>
                        <td align="center" colspan="11" style="color: red"><h4>Không có dữ liệu !</h4></td>
                    </tr>
                @else
                    @foreach($tatcaluotdatphong as $key => $val)
                        <tr>
                            <td>{{ $val->mact }}</td>
                            <td>{{ $val->tenkh }}</td>
                            <td>{{ $val->sdt }}</td>
                            <td>{{ $val->songuoilon }}</td>
                            <td>{{ $val->sotreem }}</td>
                            <td>
                                <?php
                                    $tenlp = DB::table('loai_phong')->where('malp',$val->malp)->first();
                                    echo $tenlp->tenlp;
                                ?>
                            </td>
                            <td>
                                <?php
                                    $tenphong = DB::table('phong')->where('maphong',$val->maphong)->first();
                                    echo $tenphong->tenphong;
                                ?>
                            </td>
                            <td>{{ date('d-m-Y',strtotime($val->ngaydat)) }}</td>
                            <td>{{ date('d-m-Y',strtotime($val->ngayden)) }}</td>
                            <td>{{ date('d-m-Y',strtotime($val->ngaydi)) }}</td>
                            @if($val->xacnhan == 0)
                                <td>
                                    <i class="fa fa-close" style="color:red"></i>
                                    <button class="btn btn-success btnChinhSua">Chỉnh Sửa</button>
                                </td>
                            @elseif($val->xacnhan == 1)
                                <td>
                                    <i class="fa fa-check" style="color:green"></i>
                                    <button class="btn btn-success btnChinhSua">Chỉnh Sửa</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td align="center" colspan="11">{!! $tatcaluotdatphong->render() !!}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
@stop