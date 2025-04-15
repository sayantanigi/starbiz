@include('admin.header');
@include('admin.sidebar');
<style>
    .form-check {
        display: flex;
        align-items: center;
    }

    .form-check label {
        margin-left: 10px;
        font-size: 18px;
        font-weight: 500;
    }

    .form-switch .form-check-input[type=checkbox] {
        border-radius: 2em;
        height: 50px;
        width: 100px;
    }

    small>p {
        color: red;
    }

    p strong {
        font-weight: 600 !important;
        color: black !important;
    }

    .sa-confirm-button-container button {
        background-color: #146c43 !important;
        border-color: #146c43 !important;
    }
</style>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Notification List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notification</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <!-- Notifications List -->

                           
    @if ($notifications->isEmpty())
    <p>No notifications available.</p>
@else
    <div class="list-group">
        @foreach ($notifications as $notification)
            <div class="list-group-item">
                <strong>{{ $notification->first_name  }} {{ $notification->last_name  }}</strong>: {{ $notification->noti_msg }}
                <br>
                <small>{{ $notification->created_at->format('Y-m-d H:i:s') }}</small>
                <!-- Display replies for each notification -->
                @if ($notification->replies->isNotEmpty())
                <div class="list-group mt-3">
                    <h5>Replies:</h5>
                    @foreach ($notification->replies as $reply)
                        <div class="list-group-item">
                            <strong>{{ $reply->name }}</strong>: {{ $reply->noti_msg }}
                            <br>
                            <small>{{ $reply->created_at->format('Y-m-d H:i:s') }}</small>
                        </div>
                    @endforeach
                </div>
            @endif
                <br>
                <form action="{{ route('admin.notifications.send') }}" method="POST">
                    @csrf
                    <input type="hidden" name="admin_id" value="1">
                    <input type="hidden" name="user_id" value="{{ $notification->sender_id }}">
                    <input type="hidden" name="parent_notification_id" value="{{ $notification->id }}"> <!-- Link reply to the original notification -->

                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="Reply to this notification..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Send Message</button>
                </form>
                <hr>
            </div>
        @endforeach
    </div>
@endif
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end col -->
        </div>
    </div>
    <!-- End Page-content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>

    <script type="text/javascript">
        var adminUrl = ""
    </script>
    @include('admin.footer');
