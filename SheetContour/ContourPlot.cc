#include <vector>
#include <fstream>
#include <string>
#include <iostream>

#include "TStyle.h"
#include "TGraph2D.h"
#include "TAxis.h"
#include "TCanvas.h"

using namespace std;

void parseCSVLine(std::string line, std::string delimiter, std::vector<float> *v)
{
  unsigned int i = 0;
  int j = 0;
  while (i <= line.size() && j > -1)
  {
    j = line.find(delimiter, i);
    v->push_back(atof(line.substr(i, j - i).c_str()));
    i = j + 1;
  }
}

void parseCSV_fillGraph(TGraph2D *g, string inFilename)
{
  // Open CMM CSV file to read
  ifstream file(inFilename.c_str());
  string line;

  // Parse the lines and fill the TGraph2D
  unsigned int i = 0;
  while (getline(file, line))
  {
    std::vector<float> v_pos;
    parseCSVLine(line, ",", &v_pos);
    g->SetPoint(i, v_pos[0], v_pos[1], v_pos[2] * 1000.);
    ++i;
  }
}

void parseTXT_fillGraph(TGraph2D *g, string inFilename)
{
  // Open CMM TXT file to read
  ifstream file(inFilename.c_str());
  string line;

  // Skip the first 23 lines
  for (unsigned int i = 0; i < 23; ++i)
    getline(file, line);

  // Parse the next lines and fill the TGraph2D
  unsigned int i = 0;
  while (getline(file, line))
  {
    if (line.size() > 1)
    {
      if (line.substr(2, 2) == "X=")
      {
        unsigned int j = line.find(" ", 4);
        float x = atof(line.substr(4, j - 1).c_str());
        unsigned int k = line.find(" ", 17);
        float y = atof(line.substr(17, k - 1).c_str());
        float z = atof(line.substr(30).c_str());
        g->SetPoint(i, x, y, z * 1000.);
        ++i;
      }
    }
  }
}

int main(int argc, char *argv[])
{
  string id;
  string inFilename;
  string descriptor;
  string outFilename;
  if (argc >= 5)
  {
    id = argv[1]; // sheet id
    inFilename = argv[2];
    descriptor = argv[3];  // title of graph
    outFilename = argv[4]; // output file name
  }
  else
  {
    std::cout << "At least three arguments, filedir, inFilename, outFilename, expected by ContourPlot. Did not get that." << std::endl;
    return -1;
  }

  // Book a TGraph2D object
  TGraph2D *g = new TGraph2D();

  // Check if file is .txt or .csv and parse accordingly
  // Fill the TGraph2D object
  string fileExtension = inFilename.substr(inFilename.size() - 3);
  string inFileNamePath = "../../phase_2/files/sheet/" + id + "/" + inFilename;
  // string inFileNamePath = inFilename;
  if (fileExtension == "csv" || fileExtension == "CSV")
    parseCSV_fillGraph(g, inFileNamePath);
  else if (fileExtension == "txt" || fileExtension == "TXT")
    parseTXT_fillGraph(g, inFileNamePath);

  // Pretty up the TGraph2D
  g->SetTitle((descriptor + "; x (mm); y (mm); #mum").c_str());
  TStyle *style = new TStyle();
  style->SetCanvasBorderMode(0);
  style->SetCanvasColor(0);
  style->SetPalette(1, 0);
  style->SetPadRightMargin(0.17);
  style->SetPadLeftMargin(0.12);
  style->SetTitleXOffset(1.0);
  style->SetTitleYOffset(1.52);
  style->SetTitleFillColor(0);
  style->SetTitleBorderSize(0);
  style->SetTitleW(1);
  style->cd();

  // Draw and save the plot
  TCanvas *c = new TCanvas("c", "c", 700, 700);
  g->Draw("colz cont4");
  std::string outFile = "../../phase_2/pics/sheet/" + id + "/" + outFilename;
  // std::string outFile = outFilename;
  c->SaveAs(outFile.c_str());

  return 0;
}
