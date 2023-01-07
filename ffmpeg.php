<?php 
header('Cross-Origin-Embedder-Policy: require-corp');
header('Cross-Origin-Opener-Policy: same-origin');
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
<script src="/node_modules/@ffmpeg/ffmpeg/dist/ffmpeg.min.js"></script>
<title>SVEdit v2</title>
<script src="./playerjs.js"></script>
</head>
<script type="text/javascript">
fIndex=-1;
const { createFFmpeg } = FFmpeg;
const ffmpeg = createFFmpeg({
  corePath: window.origin+"/node_modules/@ffmpeg/core/dist/ffmpeg-core.js",
  log: true,
});
var ffmpegLoaded = false;
(async () => {
	const response = await fetch('/ubuntu.ttf')
const data = await response.arrayBuffer();
ubuntu = new Uint8Array(data)
 
  await ffmpeg.load().then(res=>{
  ffmpegLoaded = true;
  		ffmpeg.setProgress(({ ratio }) => {
			perecent = Math.round(ratio.toFixed(2)*100)+"%";
			console.log(perecent,ratio);
			$("#progressbar")[0].style.width=(perecent);
			$('#progressbar').html(perecent);
		});
  	ffmpeg.FS('writeFile', 'ubuntu.ttf',ubuntu);
  });
})();
var upload_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Загрузка видео</h5>\
	<div class="mb-3">\
	  <label for="formFile" class="form-label">Файл</label>\
	  <input class="form-control" type="file" id="formFile">\
	</di>\
    <p class="card-text"><button type="button" id="uploadBtn" class="btn btn-primary" onclick="upload(); $(\'#uploadBtn\').prop(\'disabled\',true);">Загрузить</button></div></p>\
    </div>';
var concat_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Добавить видео</h5>\
	<div class="mb-3">\
	  <label for="formFile" class="form-label">Файл</label>\
	  <input class="form-control" type="file" id="formFileCONCAT">\
	</div>\
	  <p>ВНИМАНИЕ. Если в текущем проекте нет аудиодорожки, и в загруженном выше файле она отсутствует, требуется добавить аудио на текущий проект.</p>\
	<div class="form-check">\
	  <label for="formConcatAudioCON" class="form-check-label">На видеофайле загруженном выше есть аудиодорожка?</label>\
	    <input class="form-check-input" type="checkbox" value="" id="formConcatAudioCON">\
	</div>\
    <p class="card-text"><button type="button" id="concatBtn" class="btn btn-primary" onclick="concat($(\'#formConcatAudioCON\').checked); $(\'#concatBtn\').prop(\'disabled\',true);">Добавить</button></div></p>\
    </div>';
    
var addmusic_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Добавить/заменить аудио</h5>\
	<div class="mb-3">\
	  <label for="formFileMusic" class="form-label">Аудио/видео файл с музыкой</label>\
	  <input class="form-control" type="file" id="formFileMusic">\
	</div>\
    <p class="card-text"><button type="button" id="musicBtn" class="btn btn-primary" onclick="addMusic(); $(\'#musicBtn\').prop(\'disabled\',true);">Загрузить</button></div></p>\
    </div>';

var chroma_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Хромакей</h5>\
	<p><b>ВНИМАНИЕ!</b> Исходное и накладываемое видео должны быть одного разрешения, пиксель-в-пиксель!</p>\
	<div class="mb-3">\
	  <label for="formFile" class="form-label">Видео которое требуется наложить на изображение</label>\
	  <input class="form-control" type="file" id="formFileChroma">\
	  </div>\
	<div class="mb-3">\
	  <label for="formChromaColor" class="form-label">Цвет хромакея(HEX-значения следует начинать с 0x)</label>\
	  <input class="form-control" type="text" id="formChromaColor">\
	</div>\
	<div class="form-check">\
	  <label for="formChromaAudio" class="form-check-label">Пускать аудио с накладываемого видео?</label>\
	    <input class="form-check-input" type="checkbox" value="" id="formChromaAudio">\
	</div>\
    <p class="card-text"><button type="button" id="chromaBtn" class="btn btn-primary" onclick="chromakey( $(\'#formChromaColor\')[0].value,$(\'#formChromaAudio\').checked); $(\'#chromaBtn\').prop(\'disabled\',true);">Загрузить</button></div></p>\
    </div>';

var resize_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Изменить размер</h5>\
	<div class="mb-3">\
	  <label for="formSize" class="form-label">Размер(в формате ширина<b>x</b>высота)</label>\
	  <input class="form-control" type="text" id="formSize">\
	</div>\
    <p class="card-text"><button type="button" id="resizeBtn" class="btn btn-primary" onclick="convertToSize($(\'#formSize\')[0].value);$(\'#resizeBtn\').prop(\'disabled\',true);">Готово</button></div></p>\
    </div>';


var settings_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Настройки</h5>\
	<div class="mb-3">\
	  <label for="formSetpreset" class="form-label">Preset рендера(<a href="https://trac.ffmpeg.org/wiki/Encode/H.264">список тут, пункт 2</a>)</label>\
	  <input class="form-control" id="formSetpreset" type="text" placeholder="ultrafast">\
	</div>\
    <p class="card-text"><button type="button" id="resizeBtn" class="btn btn-primary" onclick="updsettings();">Готово</button></div></p>\
    </div>';


var seek_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Обрезать видео</h5>\
	<div class="mb-3">\
	  <label for="formTimes" class="form-label">Начало видео(в формате ЧЧ:ММ:СС, пример: 12:34:56)</label>\
	  <input class="form-control" type="text" id="formVTimes" value="%sttime%">\
	</div>\
	<div class="mb-3">\
	  <label for="formTimee" class="form-label">Конец видео(в формате ЧЧ:ММ:СС, пример: 12:34:56)</label>\
	  <input class="form-control" type="text" id="formVTImee" value="00:00:01">\
	</div>\
    <p class="card-text"><button type="button" id="seekBtn" class="btn btn-primary" onclick="seek(($(\'#formVTimes\')[0].value),($(\'#formVTImee\')[0].value));$(\'#seekBtn\').prop(\'disabled\',true);">Готово</button></div></p>\
    </div>';
var resize_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Изменить размер</h5>\
	<div class="mb-3">\
	  <label for="formSize" class="form-label">Размер(в формате ширина<b>x</b>высота)</label>\
	  <input class="form-control" type="text" id="formSize">\
	</div>\
    <p class="card-text"><button type="button" id="resizeBtn" class="btn btn-primary" onclick="convertToSize($(\'#formSize\')[0].value);$(\'#resizeBtn\').prop(\'disabled\',true);">Готово</button></div></p>\
    </div>';

var text_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Добавить текст</h5>\
	<div class="mb-3">\
	  <label for="formText" class="form-label">Текст</label>\
	  <input class="form-control" type="text" id="formText" value="Sample text">\
	</div>\
	<div class="mb-3">\
	  <label for="formSizeFont" class="form-label">Размер</label>\
	  <input class="form-control" type="number" id="formSizeFont" value="24">\
	</div>\
	<div class="mb-3">\
	  <label for="formXCoord" class="form-label">X-координата текста</label>\
	  <input class="form-control" type="number" id="formXCoord" value="0">\
	</div>\
	<div class="mb-3">\
	  <label for="formYCoord" class="form-label">Y-координата текста</label>\
	  <input class="form-control" type="number" id="formYCoord" value="0">\
	</div>\
	<div class="mb-3">\
	  <label for="formColorText" class="form-label">Цвет текста(любой из <a href="https://ffmpeg.org/ffmpeg-filters.html#drawtext">этого списка</a>)</label>\
	  <input class="form-control" type="text" id="formColorText" value="black">\
	</div>\
	<div class="mb-3">\
	  <label for="formTimes" class="form-label">Начало текста(в формате ЧЧ:ММ:СС, пример: 12:34:56)</label>\
	  <input class="form-control" type="text" id="formTimes" value="%sttime%">\
	</div>\
	<div class="mb-3">\
	  <label for="formTimee" class="form-label">Конец текста(в формате ЧЧ:ММ:СС, пример: 12:34:56)</label>\
	  <input class="form-control" type="text" id="formTimee" value="00:00:01">\
	</div>\
    <p class="card-text"><button type="button" id="textBtn" class="btn btn-primary" onclick="text(($(\'#formText\')[0].value),($(\'#formColorText\')[0].value),($(\'#formSizeFont\')[0].value),($(\'#formTimes\')[0].value),($(\'#formTimee\')[0].value),($(\'#formXCoord\')[0].value),($(\'#formYCoord\')[0].value));$(\'#textBtn\').prop(\'disabled\',true);">Готово</button></div></p>\
    </div>';
var compress_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Сжать видео</h5>\
	<div class="mb-3">\
	  <label for="formSize" class="form-label">CRF(Constant-Rate-Factor)</label>\
	  <p>Значение должно быть от 0 до 51. <br>Перечень CRF и их качеств: <br>0 - видео без потерь(loseless), 23 - значение по умолчанию, 23-30 - смотрибельно, 30-35 - неприятно для просмотра, 35-51 - ужасно.</p>\
	  <input class="form-control" type="number" id="CRF">\
	</div>\
    <p class="card-text"><button type="button" id="crfBtn" class="btn btn-primary" onclick="compress($(\'#CRF\')[0].value);$(\'#crfBtn\').prop(\'disabled\',true);">Готово</button></div></p>\
    </div>';
var clean_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Очистить ОЗУ</h5>\
	<div class="mb-3">\
	<p>Если вы хотите очистить ОЗУ, то вы можете удалить некоторые файлы.</p>\
	</div>\
    <p class="card-text"><button type="button" id="cleanAllMemBtn" class="btn btn-primary" onclick="cleanMem(\'all\');$(\'#cleanAllMemBtn\').prop(\'disabled\',true);$(\'#cleanMemBtn\').prop(\'disabled\',true);">Очистить всю память(включая файл текущего проекта)</button><button type="button" id="cleanMemBtn" class="btn btn-primary" onclick="cleanMem(\'keepProject\');$(\'#cleanMemBtn\').prop(\'disabled\',true);$(\'#cleanAllMemBtn\').prop(\'disabled\',true);">Очистить всё, кроме проекта</button></div></p>\
    </div>';
var progress_popup = '<div class="card" style="position: \
relative; width: 50vw;">\
    <div class="card-body">\
	<h5 class="card-title">Прогресс действия</h5>\
	<div class="mb-3">\
	  <label for="formSize" class="form-label">Прогресс</label>\
	  <div class="progress">\
  <div class="progress-bar" id="progressbar" role="progressbar" style="width: 70%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">25%</div>\
</div>\
	</div>\
   <button type="button" class="btn btn-primary" disabled id="progressBtn" onclick="hidepopup();" $(\'#progressBtn\').removeProp(\'disabled\');>Закрыть</button></div></p>\
    </div>';
var filename = undefined;
var fileUploaded = false;
var files = new Array();
if (localStorage.getItem("preset") != null) {
var preset = localStorage.getItem("preset");
}else{
	var preset = "ultrafast";
}

function undo(){
	fIndex-=1;
	if (fIndex >= 0 && fIndex <parseInt(files.length)-1) {
	filename = files[fIndex];
	updPlayer();
	}else{
		alert("Некуда отменять.");
	}
}
function redo(){
	fIndex+=1;
	if (fIndex <= parseInt(files.length)-1) {
	filename = files[fIndex];
	updPlayer();
}else{
	alert("Некуда повторять.")
}
}
function updsettings(){
	preset = $("#formSetpreset")[0].value;
	localStorage.setItem("preset",preset);
	alert("Успех!");
}
function cleanMem(todo){
	if (todo=='all') {
		for(var i = 0; i < files.length; i++){
			ffmpeg.FS('unlink',files[i]);
		}
		files = new Array();
		alert("Успех!");
		hidepopup();
	}else if(todo=='keepProject'){
		for(var i = 0; i < files.length; i++){
			if (filename != files[i]) {
			ffmpeg.FS('unlink',files[i]);
			}
		}
		files = new Array(filename);
		alert("Успех!");
		hidepopup();
	}
}

function upload() {
	const file = $("#formFile").prop('files')[0];
	if(typeof file=== undefined){
		alert("Сначала выберите файл!");
		$('#uploadBtn').prop('disabled',false);
		return false;
	}else{
		 file.arrayBuffer().then(buf=>{
    		ffmpeg.FS('writeFile', file.name, (new Uint8Array(buf)));
    		if(preset==""){
    			preset="ultrafast";
    		}
    		popup('progress',1); 
    		ffmpeg.run("-i",file.name,"-c:v","libx264","-c:a","aac","uploaded-"+file.name+".mp4","-preset",preset).then(r=>{
    			filename = "uploaded-"+file.name+".mp4";
    			fIndex+=1;files.push("uploaded-"+file.name+".mp4");
    		fileUploaded = true;
    		$('#uploadBtn').prop('disabled',false);
    		alert("Успех!");
    		hidepopup();
    		updPlayer();updPlayer();
    		return true;
    		})
		});
		return true;
	}
}

function concat(noAudioUploaded) {
	noAudioUploaded = !noAudioUploaded;
	const file = $("#formFileCONCAT").prop('files')[0];
	if(typeof file=== undefined){
		alert("Сначала выберите файл!");
		$('#concatBtn').prop('disabled',false);
		return false;
	}else{
		filename = file.name;
		 file.arrayBuffer().then(buf=>{
    		ffmpeg.FS('writeFile', file.name, (new Uint8Array(buf)));
			popup('progress');
			var zerolist;
			var onelist;
			var args="v=1:a=1";
			zerolist= "[0:v][0:a]";
			if (noAudioUploaded) {
				onelist = "[1:v][0:a]";
				args="v=1:a=0"
			}else{
				args="v=1:a=1";
				onelist = "[1:v] [1:a]";
			}
  		ffmpeg.run('-i',filename, '-i',file.name,"-filter_complex",zerolist+onelist+"\
concat=n=2:"+args+"[outv][outa]","-map","[outv]","-map","[outa]","-c:v","libx264","-preset",preset,"-c:a","aac","con-"+filename).then(res=>{
				alert("Успех!");
				filename = "con-"+filename;
				fIndex+=1;files.push("con-"+filename); updPlayer(); updPlayer();
				$('#progressBtn').prop('disabled',false);
				$('#concatBtn').prop('disabled',false);
				 updPlayer(); updPlayer();
			});
    		$('#concatBtn').prop('disabled',false);
		});
		return true;
	}
}

function seek(times,timee) {
	if (ffmpegLoaded && fileUploaded) {
			popup('progress');
  		ffmpeg.run('-i',filename, '-ss',times,"-to",timee,"-c:v","libx264","-preset",preset,"-c:a","aac","sek-"+filename).then(res=>{
				alert("Успех!");
				filename = "sek-"+filename;
				fIndex+=1;files.push(filename); updPlayer(); updPlayer();
				$('#progressBtn').prop('disabled',false);
				$('#seekBtn').prop('disabled',false);
			});
	}else{
		alert("Файл или ffmpeg ещё не загружены!");
		$('#seekBtn').prop('disabled',false);
	}
}


function addMusic() {
	const file = $("#formFileMusic").prop('files')[0];
	if(typeof file=== undefined){
		alert("Сначала выберите файл!");
		$('#musicBtn').prop('disabled',false);
		return false;
	}else{
		 file.arrayBuffer().then(buf=>{
    		ffmpeg.FS('writeFile', file.name, (new Uint8Array(buf)));
    		//fIndex+=1;files.push(file.name);
    		//fileUploaded = true;
    		//alert("Успех!");
    		popup("progress");
    		 ffmpeg.run('-i',filename, '-i', file.name,"-c:v","libx264","-preset",preset,"-c:a","aac","-map","0:v","-map","1:a","-c:v","copy","-shortest","mus-"+filename).then(res=>{
						filename = "mus-"+filename;
						fIndex+=1;files.push(filename); updPlayer(); updPlayer();
						$('#progressBtn').prop('disabled',false);
    				$('#musicBtn').prop('disabled',false); 	
    				alert("Успех!");
    		 });
		});
		return true;
	}
}

function text(text,color,size,times,timee,x,y){
	//-vf "drawtext=enable='between(t,12,3*60)':fontfile=/ubuntu.ttf: text='Test Text':fontcolor=white:fontsize=24" -acodec copy output.mp4
	if (ffmpegLoaded) {
		times = times.split(":");
		timee = timee.split(":");
		times = (parseInt(times[0])*60*60)+(parseInt(times[1])*60)+(parseInt(times[2]))
		timee = (parseInt(timee[0])*60*60)+(parseInt(timee[1])*60)+(parseInt(timee[2]))
		if(times.length <3 || timee.length <3){
			alert("Время указано в неверном формате.");
		}else{
		popup('progress');
  		ffmpeg.run('-i',filename, '-vf', "drawtext=\"enable='between(t,"+times+","+timee+"		)':fontfile=/ubuntu.ttf: text='"+text.replace("'","\\'")+"':fontcolor="+color.replace("'","\\'")+":fontsize="+size+":x="+x+":y="+y+"\"","-c:v","libx264","-preset",preset,"-c:a","aac","-acodec","copy","txt-"+filename).then(res=>{
				alert("Успех!");
				filename = "txt-"+filename;
				fIndex+=1;files.push(filename); updPlayer(); updPlayer();
				$('#progressBtn').prop('disabled',false);
				$('#textBtn').prop('disabled',false);
			});
  		}
	}else{
		alert("FFmpeg или файл не загружен.");
		$('#textBtn').prop('disabled',false);
	}
}

function compress(crf){
	if (parseInt(crf) <= 51 && parseInt(crf) >= 0) {
		if (ffmpegLoaded) {
		popup('progress');
  		ffmpeg.run('-i',filename, '-crf', crf,"-c:v","libx264","-preset",preset,"-c:a","aac","size-"+filename).then(res=>{
				alert("Успех!");
				filename = "crf-"+filename;
				fIndex+=1;files.push(filename); updPlayer(); updPlayer();
				$('#progressBtn').prop('disabled',false);
				$('#crfBtn').prop('disabled',false);
			});
		}else{
			alert("FFmpeg или файл не загружен.");
			$('#crfBtn').prop('disabled',false);
		}
	}else{
		alert("Неверное значение.");
		$('#crfBtn').prop('disabled',false);
	}
}
function dlFile(){
	if (fileUploaded && ffmpegLoaded) {
		downloadBlob(ffmpeg.FS('readFile',filename), "Project.mp4", 'application/octet-stream');
	}
}
function dlFileFN(fn,dlFileName){
	if (fileUploaded && ffmpegLoaded) {
		downloadBlob(ffmpeg.FS('readFile',fn), dlFileName, 'application/octet-stream');
	}
}
function dlFiles(fn){
if (fileUploaded && ffmpegLoaded) {
	for (var i = 0; i < files.length; i++) {
		dlFileFN(files[i],"ProjectFile - Change #"+i+".mp4");
	}
}
}
function showpopup(){
	$(".popup-bg").fadeIn();
	$("#popup").fadeIn();
}
function popup(name,ignore) {
		if(name == 'upload'){
			if (ffmpegLoaded) {
			$("#popup")[0].innerHTML = upload_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("FFmpeg не готов. Пожалуйста, подождите и повторите попытку.");
			}
		}else if(name == 'progress'){
			if (fileUploaded && ffmpegLoaded || ffmpegLoaded&&ignore==1) {
			$("#popup")[0].innerHTML = progress_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'resize'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = resize_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'clean'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = clean_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'compress'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = compress_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'text'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = text_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'chromakey'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = chroma_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'addmusic'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = addmusic_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'seek'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = seek_popup.replace("%sttime%",getstarttime());
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'concat'){
			if (fileUploaded && ffmpegLoaded) {
			$("#popup")[0].innerHTML = concat_popup	;
			showpopup();
			}else{
				alert("Файл или ffmpeg ещё не загружен.");
			}
		}else if(name == 'settings'){
			$("#popup")[0].innerHTML = settings_popup.replace("%sttime%",getstarttime());
			showpopup();
		}
	}
var noHidePopup = false;
function hidepopup() {
	if (!noHidePopup) {
	$(".popup-bg").fadeOut();
	$("#popup").fadeOut();
	}
}

function chromakey(chromacolor,chromaselect){
	const file = $("#formFileChroma").prop('files')[0];
	if(typeof file=== undefined){
		alert("Сначала выберите файл!");
		$('#chromaBtn').prop('disabled',false);
		return false;
	}else{
		//filename = file.name;
		 file.arrayBuffer().then(buf=>{
		 	if (chromaselect) {
		 		let video = 1;
		 	}else{
		 		let video = 0;
		 	}
    		ffmpeg.FS('writeFile', file.name, (new Uint8Array(buf)));
  			popup('progress');
  			ffmpeg.run('-i',filename, '-i',file.name,"-preset",preset,"-filter_complex",'[1:v]colorkey='+chromacolor+':0.3:0.2[ckout];[0:v][ckout]overlay[out]','-map','[out]',"-map",video+":a?","chr-"+filename).then(res=>{
				alert("Успех!");
				filename = "chr-"+filename;
				fIndex+=1;files.push(filename); updPlayer(); updPlayer();
				$('#progressBtn').prop('disabled',false);
				$('#chromaBtn').prop('disabled',false);
			});   		
    		$('#chromaBtn').prop('disabled',false);
		});
		return true;
	}
}
function convertToSize(size) {
	size = size.split("x");
	if (fileUploaded) {
	if (size.length < 2) {
		alert("Разрешение указано в неверном формате.");
		$('#resizeBtn').prop('disabled',false);
	}else{
		popup('progress');
  	ffmpeg.run('-i',filename, '-s', size[0]+'x'+size[1],"-c:v","libx264","-preset",preset,"-c:a","aac","size-"+filename).then(res=>{
				alert("Успех!");
				filename = "size-"+filename;
				fIndex+=1;files.push(filename); updPlayer(); updPlayer();
				$('#progressBtn').prop('disabled',false);
				$('#resizeBtn').prop('disabled',false);
  	});
	}
}
}

var downloadBlob, downloadURL;

downloadBlob = function(data, fileName, mimeType) {
  var blob, url;
  blob = new Blob([data], {
    type: mimeType
  });
  url = window.URL.createObjectURL(blob);
  downloadURL(url, fileName);
  setTimeout(function() {
    return window.URL.revokeObjectURL(url);
  }, 1000);
};

downloadURL = function(data, fileName) {
  var a;
  a = document.createElement('a');
  a.href = data;
  a.download = fileName;
  document.body.appendChild(a);
  a.style = 'display: none';
  a.click();
  a.remove();
};
var player= undefined;
function updPlayer(){
	data = ffmpeg.FS('readFile',filename);
	var blob, url;
  	blob = new Blob([data], {
    	type: 'video/mp4'
  	});
  	url = window.URL.createObjectURL(blob);
	player = new Playerjs({id:"player", file:url});
}

function getstarttime(){
	if(player!=undefined){
		return toHHMMSS(player.api("time"));
	}
	return "00:00:00";
}
function toHHMMSS(time) {
    var sec_num = parseInt(time, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<div id="popup-upload" class="hidden">
	
</div>
<div id="popup" class="hidden">

</div>
<div class="popup-bg hidden" onclick="hidepopup()"></div>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SVEdit v2.0</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" onclick="popup('upload')" aria-current="page" href="#">Загрузка</a>
        </li>
		<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-expanded="false">Видео</a>
		    <ul class="dropdown-menu">
		    	<a class="dropdown-item" onclick="popup('resize')" aria-current="page" href="#">Изменить размер</a>
		    	<a class="dropdown-item" href="#" onclick="popup('compress')">Сжать видео</a>
		    	<a class="dropdown-item" href="#" onclick="popup('text')">Текст</a>
		    	<a class="dropdown-item" href="#" onclick="popup('seek')">Обрезать</a>
		    	<a class="dropdown-item" href="#" onclick="popup('concat')">Склеить видео</a>
		    	<a class="dropdown-item" href="#" onclick="popup('chromakey')">Хромакей</a>
		  </ul>
		</li>

		<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="" role="button" aria-expanded="false">Аудио</a>
		    <ul class="dropdown-menu">
          		<a class="dropdown-item" href="#" onclick="popup('addmusic')">Добавить музыку</a>
      		</ul>
        </li>

        <li class="nav-item">
        	<a class="nav-link" href="#" onclick="undo()">Отменить</a>
        </li>
        <li class="nav-item">
        	<a class="nav-link" href="#" onclick="redo()">Повторить</a>
        </li>
        <li class="nav-item">
        	<a class="nav-link" href="#" onclick="popup('settings')">Настройки</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="dlFile()">Скачать</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="dlFiles()">Скачать все файлы</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="popup('clean')">Очистка</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div id="player" class="playerjs">
	
</div>
</body>
</html>