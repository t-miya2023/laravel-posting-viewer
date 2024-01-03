<!-- モーダルのHTML -->
<div id="deleteShopModal{{ $shop->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">「{{ $shop->shop_name }}」を削除してもよろしいですか？</h5>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">キャンセル</button>
                <form id="deleteForm" method="POST" action="{{ route('dashboard.shops.destroy', $shop) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>