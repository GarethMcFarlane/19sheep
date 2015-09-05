int xpos;
int ypos;
int cirwidth;
int cirheight;

void setup() {
  size(640, 360); 
  noStroke();
  xpos = 300;
  ypos = 200;
  cirheight = 20;
  cirwidth = 20;
}

void draw() {
  background(51); 
  fill(255, 204);
  rect(xpos, ypos, cirwidth, cirheight);
  fill(255, 204);
}

void mouseDragged() 
{
    if (mouseY> width){
    ypos = width - (cirheight/2);
  } else if ( mouseY < 0){
    ypos = cirheight/2;
  } else {
    ypos =mouseY;
  }

  if (mouseX> width){
    xpos = width - (cirwidth/2);
  } else if ( mouseX < 0){
    xpos = cirwidth/2;
  } else {
    xpos =mouseX;
  }
}
