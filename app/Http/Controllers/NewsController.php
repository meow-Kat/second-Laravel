<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
                    // 建構子 ↓  因為下面的都會重複寫
    public function __construct()
    {   // 全域變數 的格式
        $this->index = 'admin.news.index';
        $this->edit = 'admin.news.edit';
        $this->edit = 'admin.news.edit';
        $this->create = 'admin.news.create';
    }

    // 限制身分別
    public function news()
    {
        $list = News::get();
        return view($this->index, compact('list'));
    }


    public function create()
    {
        $type = News::TYPE;
        return view( $this->create, compact('type'));
    }

    public function edit($id)
    {
        $type = News::TYPE;
        $record = News::find($id);
        return view( $this->edit, compact('record','type') );
    }

    public function store(Request $request)
    {
        if($request->hasFile('img')){
            $path = FileController::imgUpload($request->file('img'));
        }

        News::create([
            'type' => $request->type,
            // 會直接取今天日期
            'publish_date' => date('Y-m-d'),
            'title' => $request->title,
            // img 存路徑 這邊可以不用存圖
            'img' => $path??'',
            'content' => $request->content,
        ]);
        
        return redirect('/admin/news')->with('message', '新增成功');
    }

    public function update(Request $request, $id)
    {   
        // 刪除舊圖片要先宣告
        $old_record = News::find($id);
        // 判斷裡面有沒有檔案
        if($request->hasFile('img')){
            // 重新上傳圖片前舊的要先刪除
            // 要刪除路徑名稱(完整路徑名)
            File::delete(public_path(). $old_record->img);
            // 嚴謹的寫法取檔案
            $file = $request->file('img');
            // 如果上傳檔案資料夾不存在
            if (!is_dir('upload/')) {
                // 創一個上傳的資料夾(在public內)
                mkdir('upload/');
            }
            // 會先變成tmp檔但是要取得正確的副檔名
            $extenstion = $request->img->getClientOriginalExtension();
            // 新檔名 = 亂數.副檔名
            $filename = md5(uniqid(rand())) . '.' . $extenstion;
            $path = '/upload/' . $filename;

                      // 存什麼檔 ↓    ↓ 存到哪裡去(不寫死) ↓ 的資料夾的副檔名
            move_uploaded_file($file, public_path() . $path);
            $old_record->img = $path;
        }

        
        $old_record->type = $request->type;
        $old_record->publish_date = $request->publish_date;
        $old_record->title = $request->title;
                        // 要是路徑 
        $old_record->content = $request->content;
        $old_record->save();

        return redirect('/admin/news')->with('message', '更新成功!');
    }

    public function delete(Request $request, $id)
    {
        $old_record = News::find($id);
        $old_record->delete();

        return redirect('/admin/news')->with('message', '刪除成功!');
    }


}
