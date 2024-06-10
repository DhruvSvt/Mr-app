<nav aria-label="Page navigation example">
    <ul class="pagination float-left">
        Showing {{ $model->firstItem() }} to {{ $model->lastItem() }} of {{ $model->total() }} entries
    </ul>
    <ul class="pagination float-right">
        {{ $model->appends(['keyword' => $keyword, 'rows' => $rows])->links() }}
    </ul>
</nav>
