            <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="confirm-title">Delete conformation</h4>
                        </div>
                        <div class="modal-body" id="confirm-body">
                            <form action="">
                                {{ csrf_field() }}
                            </form>
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cance</button>
                            <button type="button" class="btn btn-danger" id="confirm-remove-btn">Yes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->