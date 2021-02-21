
let happy = [];
let sad = [];
//let tigers = [];

function preload() {
  for (let i = 0; i < 2; i++) {
    let index = nf(i + 1, 4, 0);
	let lbl1=localStorage.getItem("lbl1");
	let lbl2=localStorage.getItem("lbl2");
	
    happy[i] = loadImage(`images/`+lbl1+`/`+lbl1+`-${index}.jpg`);
    sad[i] = loadImage(`images/`+lbl2+`/`+lbl2+`-${index}.jpg`);
   // tigers[i] = loadImage(`images/tiger/tiger${index}.jpg`);
  }
}

let imgClassifier;//shapeClassifier

function setup() {
  createCanvas(400, 400);
  let customlayers = [
    {
      type: 'conv2d',
      filters: 8,
      kernelSize: 5,
      strides: 1,
      activation: 'relu',
      kernelInitializer: 'varianceScaling',
    },
    {
      type: 'maxPooling2d',
      poolSize: [2, 2],
      strides: [2, 2],
    },
    {
      type: 'conv2d',
      filters: 16,
      kernelSize: 5,
      strides: 1,
      activation: 'relu',
      kernelInitializer: 'varianceScaling',
    },
	{
      type: 'maxPooling2d',
      poolSize: [2, 2],
      strides: [2, 2],
    },
    {
      type: 'conv2d',
      filters: 16,
      kernelSize: 5,
      strides: 1,
      activation: 'relu',
      kernelInitializer: 'varianceScaling',
    },
    {
      type: 'maxPooling2d',
      poolSize: [2, 2],
      strides: [2, 2],
    },
    {
      type: 'flatten',
    },
    {
      type: 'dense',
      kernelInitializer: 'varianceScaling',
      activation: 'softmax',
    },
  ];

  let options = {
    inputs: [64, 64, 4],
    task: 'imageClassification',
    layers: customlayers,
    debug: true
  };
  imgClassifier = ml5.neuralNetwork(options);

  for (let i = 0; i < happy.length; i++) {
    imgClassifier.addData({ image: happy[i] }, { label: 'happy' });
    imgClassifier.addData({ image: sad[i] }, { label: 'sad' });
    //imgClassifier.addData({ image: tigers[i] }, { label: 'tiger' });
  }
  imgClassifier.normalizeData();
  imgClassifier.train({ epochs: 50 }, finishedTraining);
}

function finishedTraining() {
  console.log('finished training!');
  imgClassifier.save();
}

