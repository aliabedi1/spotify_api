<div class="demo">
    <style>
        .pagination-outer{ text-align: center; }
        .pagination{
            font-family: 'Abel', sans-serif;
            display: inline-flex;
            position: relative;
        }
        .pagination li a.page-link{
            color: #490404;
            background: #eee;
            font-size: 20px;
            font-weight: 600;
            line-height: 40px;
            height: 40px;
            width: 35px;
            padding: 0;
            margin: 0 7px;
            border: none;
            border-radius: 10px;
            display: block;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease 0s;
        }
        .pagination li:first-child a.page-link,
        .pagination li:last-child a.page-link{
            color: #777;
            font-size: 25px;
            line-height: 35px;
        }
        .pagination li a.page-link:hover,
        .pagination li a.page-link:focus,
        .pagination li.active a.page-link:hover,
        .pagination li.active a.page-link{
            color: #fff;
            background: #490404;
            line-height: 47px;
        }
        .pagination li a.page-link:before{
            content: '';
            background-color: #fff;
            border-radius: 30px;
            opacity: 0;
            transform-origin: top right;
            position: absolute;
            left: 0;
            top: 5px;
            right: 5px;
            bottom: 0;
            z-index: -1;
            transition: all 0.3s ease 0s;
        }
        .pagination li a.page-link:hover:before,
        .pagination li a.page-link:focus:before,
        .pagination li.active a.page-link:hover:before,
        .pagination li.active a.page-link:before{
            opacity: 1;
            transform: scale(0.15);
        }
        @media only screen and (max-width: 480px){
            .pagination{
                font-size: 0;
                display: inline-block;
                }
            .pagination li{
                display: inline-block;
                vertical-align: top;
                }
        }
    </style>
    <nav class="pagination-outer" aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item">
                <a href="#" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    </a>
                </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item active"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
                <a href="#" class="page-link" aria-label="Next">
                    <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
</div>
